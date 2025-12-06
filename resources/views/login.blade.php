<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Gus Warung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        /* Left Image Section */
        .left-images {
            height: 100vh;
            padding: 20px;
            background: #111;
        }

        .left-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 14px;
        }

        /* Right Login Section */
        .right-login {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            height: 100vh;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-title {
            text-align: center;
            font-size: 32px;
            font-weight: 800;
            color: #e64a19;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #ff5722;
            color: white;
            font-size: 1.2rem;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            text-transform: uppercase;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e64a19;
            cursor: pointer;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .left-images {
                display: none;
            }

            .right-login {
                padding: 20px;
            }

            .login-box {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid h-100">
        <div class="row h-100">

            <!-- Left Image Section -->
            <div class="col-md-7 left-images">
                <!-- Satu gambar besar -->
                <img src="img/gambar-login.png" alt="food-image"> <!-- Ganti gambar sesuai kebutuhan -->
            </div>

            <!-- Right Login Section -->
            <div class="col-md-5 right-login">
                <div class="login-box">
                    <h1 class="login-title">Gus Warung</h1>
                    <h3 class="text-center mb-4">Login</h3>
                    @if($errors->any())
                    <div class="alert danger">
                        <ul>
                            @foreach($errors->all() as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Role</label>
                            <select class="form-select" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="driver">Driver</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan username">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">email</label>
                            <input type="email" value ="{{ old('email') }}" name="email" class="form-control" placeholder="Masukkan email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="text-muted">Forgot password?</a>
                            <a href="/register" class="text-muted">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
