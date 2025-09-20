<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Controller
{
    function listTask(){
        $tasks = Tasks::where("user_id", auth()->user()->id)->where("status", NULL)->paginate(3);
        return view("welcome", compact("tasks"));
    }
    function addTask(){
        return view('tasks.add');
    }

    function addTaskPost(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->user_id = auth()->user()->id;
        if($task->save()){
            return redirect(route('home'))->with("success", "Zadatak je dodat");
        }
        return redirect(route('task.add'))->with("error", "Zadatak nije dodat");
    }

    function updateTaskStatus($id){
        if(Tasks::where("user_id", auth()->user()->id)->where('id', $id)->update(['status' => "completed"])){
            return redirect(route('home'))->with("success", "Zadatak završen");
        }
        return redirect(route('home'))->with("error", "Došlo je do greške prilikom ažuriranja, pokušajte ponovo");
    }

    function editTask($id){
        $task = Tasks::where("user_id", Auth::id())->findOrFail($id);
        return view('tasks.add', compact('task'));
    }

    function updateTask(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        $task = Tasks::where("user_id", Auth::id())->findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        if($task->save()){
            return redirect(route('home'))->with("success", "Zadatak je ažuriran");
        }
        return back()->with("error", "Zadatak nije ažuriran");
    }

    function deleteTask($id){
        if(Tasks::where("user_id", auth()->user()->id)->where('id', $id)->delete()){
            return redirect(route('home'))->with("success", "Zadatak je obrisan");
        }
        return redirect(route('home'))->with("error", "Došlo je do greške prilikom obrisanja");
    }

}
