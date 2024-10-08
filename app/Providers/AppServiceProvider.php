<?php

namespace App\Providers;

use Illuminate\Support\Facades\View; 
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        $completed = Task::join('users', 'tasks.assigned_to', '=', 'users.id')
        ->where('tasks.process', 'Completed')
        ->select('tasks.*', 'users.name as assigned_user')
        ->orderBy('tasks.created_at', 'desc')  
        ->get()
        ->toArray();        
        View::share('completed', $completed);
       
        Schema::defaultStringLength(191);
    }
}
