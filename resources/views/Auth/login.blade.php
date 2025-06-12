<!DOCTYPE html>
<html lang="sq">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>UKZ Admin Login</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
            rel="stylesheet"
        />
        <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .custom-aside {
            background-color: #113f67;
            color: white;
        }
        .custom-input {
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }
        .custom-input:focus {
            border-color: #113f67;
            box-shadow: 0 0 10px rgba(17, 63, 103, 0.2);
        }
        .custom-btn {
            background-color: #113f67;
            border-color: #113f67;
        }
        .custom-btn:hover {
            background-color: #0f355b;
            border-color: #0f355b;
        }
        .input-group-text {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        @media screen and (max-width: 768px) {
            .custom-container {
                flex-direction: column;
            }
            .custom-aside {
                width: 100%;
                height: 40%;
                justify-content: center;
            }
            .custom-aside div {
                text-align: center;
            }
            .custom-main {
                width: 100%;
                height: 60%;
                justify-content: center;
            }
            .custom-form {
                width: 80%;
            }
        }
        </style>
    </head>
    <body>
        <div class="d-flex custom-container h-100">
            <aside
                class="custom-aside d-flex flex-column justify-content-center align-items-center col-md-4 col-12 h-md-100"
            >
                <div>
                    <h1 class="display-4">Welcome to UKZ</h1>
                    <p class="lead">This is the admin panel for UKZ Management.</p>
                </div>
            </aside>
            <main
                class="custom-main d-flex justify-content-center align-items-center col-md-8 col-12 h-md-100"
            >
                <div class="custom-form col-12 col-md-6">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                id="username"
                                class="form-control custom-input @error('username') is-invalid @enderror"
                                name="username"
                                value="{{ old('username') }}"
                                required
                            />
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control custom-input @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    required
                                />
                                <span class="input-group-text" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </span>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn custom-btn text-white">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <script>
                function togglePassword() {
                    const passwordInput = document.getElementById("password");
                    const toggleIcon = document.getElementById("togglePasswordIcon");
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        toggleIcon.classList.remove("bi-eye");
                        toggleIcon.classList.add("bi-eye-slash");
                    } else {
                        passwordInput.type = "password";
                        toggleIcon.classList.remove("bi-eye-slash");
                        toggleIcon.classList.add("bi-eye");
                    }
                }
                </script>
    </body>
</html>
