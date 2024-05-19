<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tecnologia Web 1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home<span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                </ul>
                <form class="d-flex">
                    <img src="https://scontent.ftru2-2.fna.fbcdn.net/v/t39.30808-6/295414605_774221967359423_5913598985040203296_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=5f2048&_nc_ohc=uTc7RJ5AQ70Q7kNvgHeNq3x&_nc_ht=scontent.ftru2-2.fna&oh=00_AYDoKZpEM9t7KwlXP65SPMd0AUnB2kXfjc00WSNEp6rrUQ&oe=664F4724" 
                    alt="Profile Picture" class="card border-white border-2 rounded-circle" style="width: 50px; height: 50px;">         
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card border-primary text-primary border-2" style="border-radius: 1rem;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-md-5 pb-5">
                            <h1>LISTA DE TAREAS</h1>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h5>N° tareas</h5>
                                        </div>
                                        <div class="col">
                                            <h5>{{ $tasks->count() }}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Pendientes</h5>
                                        </div>
                                        <div class="col">
                                            <h5>{{ $tasks->count() }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-task mt-2">
                                <h3>Agregar Tarea</h3>
                                <form action="{{ url('/') }}" method="POST" class="input-group mb-3">
                                    @csrf
                                    <input type="text" class="form-control" name="task" placeholder="Ingresar tarea">
                                    <button class="btn btn-success" type="submit">AGREGAR</button>
                                </form>
                            </div>

                            <div class="list-task-all card border-primary border-2" style="border-radius: 1rem;">
                                <ul class="mt-2">
                                    @foreach ($tasks as $task)
                                        <li class="d-flex align-items-center">
                                            <div class="form-check d-flex justify-content-between w-100">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios{{ $task->id }}" value="{{ $task->id }}" onchange="toggleTaskCompletion(this)">
                                                    <label class="form-check-label ms-2" for="optionsRadios{{ $task->id }}">
                                                        {{ $task->task }}
                                                    </label>
                                                </div>
                                                <div class="d-flex">
                                                    <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill me-2" type="submit">
                                                            <i class="bi bi-trash-fill">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                                </svg>
                                                            </i>
                                                        </button>
                                                    </form>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script>
    function toggleTaskCompletion(checkbox) {
  // Get the task ID from the checkbox value
  const taskId = checkbox.value;

  // Check if the task is being marked as completed or uncompleted
  const isCompleted = checkbox.checked;

  // Update the task completion status in the database (using AJAX)
  updateTaskCompletion(taskId, isCompleted);

  // Update the UI to reflect the task completion status
  toggleTaskStrikethrough(checkbox, isCompleted);
  updatePendingCount(isCompleted);
}

function updateTaskCompletion(taskId, isCompleted) {
  const url = '/tasks/' + taskId; // Replace with your actual route URL
  const data = { completed: isCompleted }; // JSON data with task ID and completion status

  fetch(url, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
    // Handle successful or unsuccessful update response
    if (data.success) {
      // Task completion updated successfully
    } else {
      // Error occurred during update
      console.error('Error updating task:', data.error);
    }
  })
  .catch(error => {
    console.error('AJAX error:', error);
  });
}

function toggleTaskStrikethrough(checkbox, isCompleted) {
  const taskListItem = checkbox.parentNode.parentNode; // Get the task list item
  if (isCompleted) {
    taskListItem.classList.add('task-completed'); // Add strikethrough class
  } else {
    taskListItem.classList.remove('task-completed'); // Remove strikethrough class
  }
}

function updatePendingCount(isCompleted) {
  const pendingCountElement = document.getElementById('pendingCount'); // Get pending count element
  let currentPendingCount = parseInt(pendingCountElement.textContent);

  if (isCompleted) {
    currentPendingCount--; // Decrement pending count
  } else {
    currentPendingCount++; // Increment pending count
  }

  pendingCountElement.textContent = currentPendingCount; // Update displayed count
}
</script>
</html>
