<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-4/assets/css/login-4.css">
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container">
            @if ($errors->any())
                <div>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                            src="https://img.freepik.com/free-photo/3d-illustration-pen-putting-blue-ticks-paper_107791-15675.jpg?t=st=1713078733~exp=1713082333~hmac=273a05274f16c10700f1e457279975eb20b7e4b36aa615ea61ab9d2a3a345c6e&w=996"
                            alt="ToDoApp Image">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <h3 class="text-center fs-2 fw-bold">Todolist APP</h3>
                                    </div>
                                    <h3 class="mb-3">Register</h3>
                                </div>
                            </div>
                            <form action="/register" method="post">
                                @csrf
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input name="name" type="text" class="form-control" id="name"
                                                placeholder="Name" required>
                                            <label for="name">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input name="email" type="email" class="form-control" id="email"
                                                placeholder="Email" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input name="password" type="password" class="form-control" id="password"
                                                placeholder="Password" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                id="password_confirmation" placeholder="Confirm Password" required>
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-primary" type="submit">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-4 text-center">
                                <p>You have an account? <a href="/login">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        }, 1500);
    </script>

</body>

</html>
