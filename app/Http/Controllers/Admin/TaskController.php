<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class TaskController extends Controller
{
    public function index(){

        $users = User::select('id','name')->where('role', 'user')->get()->toArray();
   
        $tasks = Task::select('*')->paginate(6)->toArray(); // Paginate with 6 items per page
        // $tasks = Task::select('*')->get()->toArray();
        $completedTasks = Task::select('*')->where('process','Completed')->get()->toArray();
      
        return view('admin.task')->with(compact('users','tasks','completedTasks'));
    }

    public function insert(Request $request){
        $post = $request->all();
      
        try {
            $request->validate([
                'taskName' => 'required|string|max:255',
                'details' => 'required|string', 
                'date' => 'required|date', 
                'priority' => 'required|string|in:low,medium,high', 
                'process' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }

        // Create a new task
        $task = new Task();
        $task->title = isset($post['taskName']) ? $post['taskName'] : '';
        $task->description = isset($post['details']) ? $post['details'] : '';
        $task->date = isset($post['date']) ? $post['date'] : '';
        $task->priority = isset($post['priority']) ? $post['priority'] : '';
        $task->assigned_to = isset($post['assign']) ? $post['assign'] : '';
        $task->process = isset($post['process']) ? $post['process'] : '';
        $task->created_by = Auth::user()->id;
        $task->created_at = Carbon::now();
        $task->save();

        // Response
        return response()->json([
            'message' => 'task added successfully',
            'status' => 'success',
            'data' => $task,
        ], 201);
    }
    public function update(Request $request,$userId){
        $post = $request->all();
       $currentUser = Auth::user();
      
       if($currentUser->role == 'user'){
        $task = Task::where('id', $userId)->first();
        $task->process = isset($post['process']) ? $post['process'] : '';
        $task->updated_at = Carbon::now();
        $task->save();  
        
        return response()->json([
            'message' => 'task updated successfully',
            'status' => 'success',
            'data' => $task,
        ], 201);
    }else{
        try {
            $request->validate([
                'taskName' => 'required|string|max:255',
                'details' => 'required|string', 
                'date' => 'required|date', 
                'priority' => 'required|string|in:low,medium,high', 
                'process' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }

        // update  task
        $task = Task::where('id', $userId)->first();
        $task->title = isset($post['taskName']) ? $post['taskName'] : '';
        $task->description = isset($post['details']) ? $post['details'] : '';
        $task->date = isset($post['date']) ? $post['date'] : '';
        $task->priority = isset($post['priority']) ? $post['priority'] : '';
        $task->assigned_to = isset($post['assign']) ? $post['assign'] : '';
        $task->process = isset($post['process']) ? $post['process'] : '';
        $task->created_by = Auth::user()->id;
        $task->updated = Carbon::now();
        $task->save();

        // Response
        return response()->json([
            'message' => 'task updated successfully',
            'status' => 'success',
            'data' => $task,
        ], 201);
    }
       
    }
    public function edit($userId){
        $task = Task::where('id', $userId)->first();

        return response()->json($task, 200);
    }

    public function delete($userId){
       
        try {
            $task = Task::where('id',$userId)->first();
    
            $task->delete();
    
            return response()->json([
                'message' => 'task deleted successfully',
                'status' => 'success'
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete user. Please try again later.'], 500);
        }
    }
}
