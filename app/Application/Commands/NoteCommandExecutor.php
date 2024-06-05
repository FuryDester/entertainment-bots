<?php

namespace App\Application\Commands;

use App\Domain\Commands\Factories\Common\CommandArgumentDTOFactoryContract;
use App\Domain\Common\Services\Models\UserServiceContract;
use App\Domain\Notes\Factories\NoteDTOFactoryContract;
use App\Domain\Notes\Services\Models\NoteServiceContract;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\Commands\DataTransferObjects\Common\CommandArgumentDTO;
use App\Infrastructure\Notes\DataTransferObjects\NoteDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

final readonly class NoteCommandExecutor extends AbstractCommandExecutor
{
    use SendMessage;

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Показывает/добавляет/изменяет заметки';
    }

    /**
     * {@inheritDoc}
     */
    public function getUsage(): string
    {
        return <<<TEXT
заметка тест - вывод заметки, заметка тест + пересланное сообщение - добавление\изменение заметки
TEXT;
    }

    /**
     * {@inheritDoc}
     */
    public function getAliases(): array
    {
        return ['заметка', 'заметки', 'з'];
    }

    /**
     * {@inheritDoc}
     */
    public function getArguments(CommandArgumentDTOFactoryContract $factory): array
    {
        return [
            $factory::createFromParams('название', 'Название заметки для обновления\просмотра. Например: конкурс'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(MessageDTO $message, array $arguments): bool
    {
        /** @var NoteServiceContract $noteService */
        $noteService = app(NoteServiceContract::class);

        $nameArgument = current($arguments);
        if (! $nameArgument->getValue()) {
            $this->printAllNotes($message, $noteService);

            return true;
        }

        $replyMessage = $message->getReplyMessage() ?: current($message->getFwdMessages());
        if (! $replyMessage || ! $replyMessage->getText()) {
            return $this->tryShowNote($message, $nameArgument, $noteService);
        }

        /** @var UserServiceContract $userService */
        $userService = app(UserServiceContract::class);
        $user = $userService->findByVkIdAndPeerId($message->getFromId(), $message->getPeerId());
        if (! $user->isAdmin()) {
            return $this->tryShowNote($message, $nameArgument, $noteService);
        }

        $this->editNote($message, $nameArgument, $noteService);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function onlyForPersonalMessages(): bool
    {
        return false;
    }

    private function printAllNotes(MessageDTO $message, NoteServiceContract $service): void
    {
        $notes = $service->getByPeerId($message->getPeerId());
        $text = 'Заметки отсутствуют';
        if (count($notes)) {
            $text =
                "Доступные заметки:\n"
                .implode("\n", Arr::map($notes, static function (NoteDTO $note) {
                    $dateTime = $note->getUpdatedAt()->format('Y-m-d H:i:s');

                    return "🗂 {$note->getName()} - добавлена в $dateTime";
                }));
        }

        $this->sendMessage($message->getPeerId(), $text);
    }

    private function tryShowNote(MessageDTO $message, CommandArgumentDTO $nameArgument, NoteServiceContract $service): bool
    {
        $note = $service->getByNameAndPeerId($nameArgument->getValue(), $message->getPeerId());
        if (! $note) {
            $this->sendMessage($message->getPeerId(), "Заметки \"{$nameArgument->getValue()}\" не существует.");

            return false;
        }

        $text = "Заметка \"{$nameArgument->getValue()}\":\n{$note->getText()}";
        $this->sendMessage($message->getPeerId(), $text);

        return true;
    }

    private function editNote(MessageDTO $message, CommandArgumentDTO $nameArgument, NoteServiceContract $service): void
    {
        $replyMessage = $message->getReplyMessage() ?: current($message->getFwdMessages());
        if (! $replyMessage || ! $replyMessage->getText()) {
            Log::error('NoteCommand::editNote no replyMessage found!', [
                'message' => $message->toArray(),
                'name' => $nameArgument->getValue(),
            ]);
        }

        $note = $service->getByNameAndPeerId($nameArgument->getValue(), $message->getPeerId());
        if (! $note) {
            /** @var NoteDTOFactoryContract $noteFactory */
            $noteFactory = app(NoteDTOFactoryContract::class);

            $note = $noteFactory::createFromData([
                'name' => $nameArgument->getValue(),
                'peer_id' => $message->getPeerId(),
                'user_id' => $message->getFromId(),
                'text' => $replyMessage->getText(),
            ]);

            $text = 'Заметка сохранена!';
            $saveResult = $service->save($note);
            if (! $saveResult) {
                Log::error('NoteCommand::editNote cannot save new note!', [
                    'message' => $message->toArray(),
                    'name' => $nameArgument->getValue(),
                    'replyMessage' => $replyMessage->toArray(),
                    'note' => $note->toArray(),
                ]);

                $text = 'Не удалось сохранить заметку.';
            }

            $this->sendMessage($message->getPeerId(), $text);

            return;
        }

        $note->setText($replyMessage->getText());
        $editResult = $service->save($note);

        $text = 'Заметка обновлена!';
        if (! $editResult) {
            Log::error('NoteCommand::editNote cannot edit note!', [
                'message' => $message->toArray(),
                'name' => $nameArgument->getValue(),
                'replyMessage' => $replyMessage->toArray(),
                'note' => $note->toArray(),
            ]);

            $text = 'Не удалось обновить заметку.';
        }

        $this->sendMessage($message->getPeerId(), $text);
    }
}
