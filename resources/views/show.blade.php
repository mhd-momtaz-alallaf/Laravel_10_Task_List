@extends('layouts.app')

@section('title', $task->title)

@section('content')

    <p>{{ $task->description }}</p>

    @if ($task->long_description)
    <p>{{ $task->long_description }}</p>
    @endif

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>

    <p>
        @if($task->completed)
        Completed
        @else
        Not Completed
        @endif
    </p>


    <div>
        <a href="{{ route('tasks.edit', ['task' => $task] ) }}">Edit</a>
    </div> <!-- we can just pass the whole Model like this: ['task' => $task] inested of pass =>$task->id and laravel will know that there are a primary key to use as an $id -->

    <div>
        <form action="{{route('tasks.toggle-complete',['task' => $task] )}}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">
                Mark As {{ $task->completed ? 'Not Completed' : 'Completed' }}
            </button>
        </form>
    </div>

    <div>
        <form action="{{route('tasks.destroy',['task' => $task] )}}" method="POST">
            @csrf
            <!-- Method Spoofing -->
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>

@endsection
