<?php

namespace App\Providers;

use App\Events\Common\UserUpdated;
use App\Events\Quiz\QuizUserStatusUpdated;
use App\Events\Vk\VkEventUpdated;
use App\Listeners\Common\DropUserCache;
use App\Listeners\Quiz\DropQuizUserStatusCache;
use App\Listeners\Vk\DropVkEventCache;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        VkEventUpdated::class => [DropVkEventCache::class],
        UserUpdated::class => [DropUserCache::class],
        QuizUserStatusUpdated::class => [DropQuizUserStatusCache::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
