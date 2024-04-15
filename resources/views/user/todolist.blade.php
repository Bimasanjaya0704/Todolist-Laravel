@extends('layout.main')

@section('container')
    <div class="container py-5 min-vh-100">
        @if (isset($error))
            <div>
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            </div>
        @endif

        <div class="mb-3">
            <form method="post" action="/logout">
                @csrf
                <button class="btn btn-danger">Sign Out</button>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card rounded-3">
                    <div class="card-body">
                        <h4 class="text-center fs-5 fw-bold">Add New Todo</h4>
                        <form method="post" action="/todolist">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control" name="todo" id="todo">
                                <label for="todo">Enter a new task here</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card rounded-3">
                    <div class="card-body">
                        <h4 class="text-center fs-5 fw-bold">Todo Finish</h4>
                        <ul class="list-group list-group-flush">
                            @foreach ($todolist as $todo)
                                @if (isset($todo['status']) && $todo['status'] === 'finished')
                                    <li class="list-group-item">{{ $todo['todo'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card rounded-3">
                    <div class="card-body">
                        <h4 class="text-center fs-5 fw-bold">Todolist Table</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Todo item</th>
                                        <th scope="col">Todo Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todolist as $index => $todo)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $todo['todo'] }}</td>
                                            <td>
                                                @if (isset($todo['status']))
                                                    @if ($todo['status'] === 'unfinished')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif ($todo['status'] === 'finished')
                                                        <span class="badge bg-success">Finished</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Unknown</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Todo Actions">
                                                    @if (isset($todo['status']) && $todo['status'] === 'unfinished')
                                                        <form action="/todolist/{{ $todo['id'] }}/finish" method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-success me-2">Finished</button>
                                                        </form>
                                                    @endif
                                                    <form action="/todolist/{{ $todo['id'] }}/delete" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Menghilangkan pesan error setelah 5 detik
        setTimeout(function() {
            var errorAlert = document.querySelector('.alert');
            if (errorAlert) {
                errorAlert.style.transition = "opacity 1s ease";
                errorAlert.style.opacity = "0";
                setTimeout(function() {
                    errorAlert.remove();
                }, 1000);
            }
        }, 2000);
    </script>
@endsection
