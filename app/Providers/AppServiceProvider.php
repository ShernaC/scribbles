<?php

namespace App\Providers;

// use App\Policies\PostPolicy;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\UserRegistered::class => [
            \App\Listeners\SendWelcomeEmail::class,
        ],
    ];
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('own-post', function(User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        // Gate::policy(Order::class, OrderPolicy::class);
    
    }
}
