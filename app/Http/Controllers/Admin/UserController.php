<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::where('role', 'user')->get()->toArray();
        // $users = User::paginate(10); 
        $users = User::where('role', 'user')->paginate(10)->toArray();
        return view('admin.user')->with(compact('users'));
    }

    public function insert(Request $request)
    {
        $post = $request->all();
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }

        // Create a new user
        $user = new User();
        $user->name = isset($post['name']) ? $post['name'] : '';
        $user->designation = isset($post['designation']) ? $post['designation'] : '';
        $user->email = isset($post['email']) ? $post['email'] : '';
        $user->password = isset($post['password']) ? bcrypt($post['password']) : '';
        $user->role = 'user';
        $user->created_at = Carbon::now();
        $user->save();

        // Response
        return response()->json([
            'message' => 'user added successfully',
            'status' => 'success',
            'data' => $user,
        ], 201);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return response()->json($user, 200);
    }
    public function update(Request $request, $userId)
    {
        $post = $request->all();
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }
        
           // update the user
           $user = User::where('id', $userId)->first();
           $user->name = isset($post['name']) ? $post['name'] : '';
           $user->designation = isset($post['designation']) ? $post['designation'] : '';
           $user->email = isset($post['email']) ? $post['email'] : '';
           $user->password = isset($post['password']) ? bcrypt($post['password']) : '';
           $user->role = 'user';
           $user->updated_at = Carbon::now();
           $user->save();
   
           // Response
           return response()->json([
               'message' => 'user updated successfully',
               'status' => 'success',
               'data' => $user,
           ], 201);
    }
    public function delete(Request $request, $userId)
    {
        try {

            $tasks = Task::where('assigned_to', $userId)->get(); 

            foreach ($tasks as $task) {
                $task->delete(); 
            }
            $user = User::where('id',$userId)->first();
    
            $user->delete();
    
            return response()->json([
                'message' => 'user deleted successfully',
                'status' => 'success'
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete user. Please try again later.'], 500);
        }
    }
    
}
