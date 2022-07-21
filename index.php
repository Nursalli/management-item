<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Muhammad Nursalli">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/styleLogin.css">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="#" id="login" method="POST">
            <h1 class="h3 mb-3 fw-normal">Please Login</h1>

            <!-- Alert Login Error -->
            <div id="loginError" class="alert alert-danger" role="alert" style="display: none">
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Enter Username">
                <label for="floatingUsername">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Enter Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; Muhammad Nursalli 2022 </p>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="assets/js/auth.js"></script>
</body>

</html>