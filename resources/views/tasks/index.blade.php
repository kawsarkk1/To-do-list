<!-- resources/views/tasks/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>To-Do List</h1>
        
        <!-- Form to add a new task -->
        <form action="/tasks" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <!-- List of tasks -->
        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    
                    <!-- Form to update the task -->
                    <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <!-- Checkbox to mark as completed -->
                        <input type="checkbox" 
                               {{ $task->completed ? 'checked' : '' }} 
                               onchange="this.form.submit()" 
                               name="completed" 
                               value="{{ $task->completed ? 0 : 1 }}">
                        <!-- Hidden input to keep the title the same -->
                        <input type="hidden" name="title" value="{{ $task->title }}">
                    </form>
                    
                    {{ $task->title }}

                    <!-- Form to delete the task -->
                    <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
