<h1>
  The list of tasks
</h1>

<div>
    @forelse ($tasks as $task)
        <div>
        <a href="">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse
</div>
