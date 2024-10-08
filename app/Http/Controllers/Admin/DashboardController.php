<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $totalTask =  Task::count();
        $totalUser =  User::where('role','user')->count();
        $completedTask = Task::join('users', 'tasks.assigned_to', '=', 'users.id')
        ->where('tasks.process', 'Completed')
        ->select('tasks.*', 'users.name as assigned_user')  
        ->get()
        ->toArray();
      
        
        return view('admin.home')->with(compact('totalTask','totalUser','completedTask'));
    }
}
