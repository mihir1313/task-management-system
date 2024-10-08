<?php
// app/Http/Middleware/UserMiddleware.php
namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View; 

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isUser()) {
            $userId = Auth::id(); 
          
            $userTasks = Task::where('assigned_to', $userId)
                ->where('process', 'Completed') 
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
            
            View::share('userTasks', $userTasks);

            return $next($request);
        }

        return redirect('/'); // Redirect to home or access-denied page
    }
}
