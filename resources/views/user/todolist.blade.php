@extends('layout.main')

@section('container')
    <div class="container py-5 h-100">
        @if (@isset($error))
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            </div>
        @endif
        <div class="row mb-5">
            <form method="post" action="/logout">
                @csrf
                <button class="btn btn-md btn-danger" type="submit">Sign Out</button>
            </form>
        </div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card rounded-3">

                    <div class="card-body p-4">

                        <h4 class="text-center my-3 fs-3">Todolist App</h4>
                        <p>by <a href="https://bimasanjaya.me/" target="_blank">Bima Sanjaya</a></p>


                        <form method="post" action="/todolist">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="todo" placeholder="todo">
                                <label for="todo">Enter a task here</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>


                        <table class="table mb-4 mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Todo item</th>
                                    {{-- <th scope="col">Status</th> --}}
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todolist as $todo)
                                    <tr>
                                        <th scope="row">{{ $todo['id'] }}</th>
                                        <td>{{ $todo['todo'] }}</td>
                                        {{-- <td>{{ $todo['todo'] }}</td> --}}
                                        <td>
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-danger">Delete</button>
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-success ms-1">Finished</button>
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
@endsection
