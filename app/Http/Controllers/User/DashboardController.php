<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index(){
    
    $currentUser = Auth::user();
    $totalTask = Task::where('assigned_to', $currentUser->id)->count(); 
    $completedTask = Task::where('process','Completed')->where('assigned_to', $currentUser->id)->count();
    
    return view('user.home')->with(compact('totalTask','completedTask'));
   }
}
