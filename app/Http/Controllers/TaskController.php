<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Log;
class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request){
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();
        return response()->json(['status'=>true,'message'=>'task stored successfully']);

    }

    public function edit($id){
        $task = Task::find($id);
        return response()->json(['task'=>$task]);
    }
    public function update(Request $request,$id){
        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();
        return response()->json(['starus'=>true,'message'=>'task updated successfully']);

    }

    public function status($id){
        Log::info("status function start");
        $task = Task::find($id);
        if($task->status == 0){
            $task->status = 1;
        }
        else{
            $task->status = 0;
        }
        Log::info("status function complrte");

        $task->save();
        return response()->json(['starus'=>true,'message'=>'status updated successfully']);

    }

    public function destroy($id){
        $task = Task::find($id);
        $task->delete();
        return response()->json(['starus'=>true,'message'=>'task deleted successfully']);

    }
}
