<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        $tasks = Task::where('assigned_to', $currentUser->id) 
             ->paginate(6) 
             ->toArray(); 
            //  echo '<pre>';
            //  print_r($tasks);
            //  die;
        $completedTasks = Task::select('*')->where('process', 'Completed')->where('assigned_to', $currentUser->id)->get()->toArray();

        return view('user.task')->with(compact('tasks','completedTasks'));
    }
}
