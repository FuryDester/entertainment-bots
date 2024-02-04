<?php

namespace App\Http\Requests\Api\VK;

use App\Domain\Common\Requests\ShouldFormDTO;
use App\Infrastructure\Common\Traits\Requests\AlwaysAuthorizeRequest;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use Illuminate\Foundation\Http\FormRequest;

final class CallbackRequest extends FormRequest implements ShouldFormDTO
{
    use AlwaysAuthorizeRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'event_id' => ['required', 'string'],
            'v' => ['required', 'string'],
            'object' => ['required', 'array'],
            'group_id' => ['required', 'integer'],
            'secret' => ['sometimes', 'string'],
        ];
    }

    public function formDto(): CallbackRequestDTO
    {
        $data = $this->safe()->collect();

        return (new CallbackRequestDTO())
            ->setType($data->get('type'))
            ->setEventId($data->get('event_id'))
            ->setVersion($data->get('v'))
            ->setObject($data->get('object'))
            ->setGroupId((int) $data->get('group_id'))
            ->setSecret($data->get('secret'));
    }
}
