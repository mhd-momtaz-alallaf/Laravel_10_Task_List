<?php

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function() {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function() { // this route to show all tasks from index file.
    return view('index',[
        'tasks' => Task::latest()->get() // passing the tasks to the index file to render it there.
    ]);
})->name('tasks.index');

Route::view('/tasks/create','create') // this route to open the create form page.
    ->name('tasks.create');

Route::get('/tasks/{task}', function(Task $task) { // this route to show specific task info from show file.
    return view('show',[
        'task'=> $task
    ]);
})->name('tasks.show');

Route::get('/tasks/{task}/edit', function(Task $task) { // this route to open the edit form page of specific task.
    // (/tasks/{task}/edit') && (Task $task) is Route Model binding..
    
    return view('edit',[
        'task'=> $task // type hinting the $task from Task model so that laravel will know which task to fetch without we maneually find the task by $id .
    ]);
})->name('tasks.edit');

Route::post('/tasks',function(TaskRequest $request){ // this route to send the request of create new task (from the create form) and store it into database.
    $data = $request->validated(); // validated in custom TaskRequest class.

    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($data); // simple way to create new instance of Task and auto save it but we have to pass all of the model (Task) feilds.
    // this is call mass assiment (create or update set of feilds at ones) first we need to enable fillable from the model.

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}',function(Task $task, TaskRequest $request){ // this route to send the request of updating a task (from the edit form) and store it into database.
    // $data = $request->validated();

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated()); // simple way to update an existing instance of Task (from Task Model Binding) and auto save it.
    
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task edited successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}',function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')->with('success','Task deleted successfully!');
})->name('tasks.destroy');