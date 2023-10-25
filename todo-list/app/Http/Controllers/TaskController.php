<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $user_id)
    {
        //
        if(count(Task::where('user_id', $user_id)->get()) > 0){
            $tasks = Task::where([
                'user_id' => $user_id,
                'status' => true,
                'completion_date' => null
            ])->get();
            return response()->json(['data' => $tasks, 'status' => true], 200);
        }else{
            return response()->json(['data' => 'This user don\'t have tasks', 'status' => true], 200);
        }
    }

    public function getDesativatedTasks(string $user_id)
    {
        //
        if(count(Task::where('user_id', $user_id)->get()) > 0){
            $tasks = Task::where([
                'user_id' => $user_id,
                'status' => false
            ])->get();
            return response()->json(['data' => $tasks, 'status' => true], 200);
        }else{
            return response()->json(['data' => 'This user don\'t have tasks', 'status' => true], 200);
        }
    }

    public function getCompletedTasks(string $user_id)
    {
        if(count(Task::where('user_id', $user_id)->get()) > 0){
            $tasks = Task::where([
                'user_id' => $user_id,
                'status' => true
            ])->where('completion_date', '!=', null)->get();
            return response()->json(['data' => $tasks, 'status' => true], 200);
        }else{
            return response()->json(['data' => 'This user don\'t have tasks', 'status' => true], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $task = Task::create($data);
        if($task){
            return response()->json(['data' => 'Task added successfully', 'status' => true], 200);
        }else{
            return response()->json(['data' => 'Failed to add task', 'status' => false], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $data = $request->all();
        $task = Task::where([
            'id' => $data['task_id'],
            'user_id' => $data['user_id']
        ])->get();
        if(count($task) >= 1){
            return response()->json(['data' => $task, 'status' => true], 200);
        }else{
            return response()->json(['data' => 'Error to find task', 'status' => false], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $task_id)
    {
        //
        $data = $request->all();
        $task = Task::find($task_id);
        $task->update($data);  

        if($task){
            return response()->json(['data' => "Task updated successfully", 'status' => true], 200);
        }else{
            return response()->json(['data' => 'Failed to update task', 'status' => false], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $task_id)
    {
        //
        $task = Task::find($task_id);
        if(is_null($task)){
            return response()->json(['data' => 'Failed to delete task', 'status' => false], 500);
        }else{
            $task->delete();
            return response()->json(['data' => 'Task deleted successfully', 'status' => true], 200);
        }
    }

    public function completeTask(string $task_id)
    {
        //
        $task = Task::find($task_id);
        if(is_null($task)){
            return response()->json(['data' => 'Failed to complete task', 'status' => false], 500);
        }else{
            $task->update(['completion_date' => date('Y-m-d')]);
            return response()->json(['data' => 'Task completed successfully', 'status' => true], 200);
        }
    }

}
