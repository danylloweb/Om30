<?php

namespace App\Providers;

use App\Entities\Patient;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;

class  EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->afterCreatedModels();
    }

    /**
     * afterCreatedModels
     */
    private function afterCreatedModels()
    {
        Patient::created(function () {
            Cache::store('redis')->tags('patients')->flush();
        });
        Patient::updated(function () {
            Cache::store('redis')->tags('patients')->flush();
        });
        Patient::deleted(function () {
            Cache::store('redis')->tags('patients')->flush();
        });
    }
}
