<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container col-md-4">
    <h3 class="text-center mb-4">Register</h3>

    <form method="POST" action="{{ route('register.action') }}">
        @csrf

        <input type="text" name="name" class="form-control mb-3" placeholder="Nama">

        <input type="email" name="email" class="form-control mb-3" placeholder="bebas@role.com">

        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <select name="role" class="form-control mb-3">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="driver">Driver</option>
        </select>

        <button class="btn btn-success w-100">Daftar</button>
    </form>
</div>

</body>
</html>
