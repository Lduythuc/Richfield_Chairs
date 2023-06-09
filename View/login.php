<?php
require_once 'utils.php';
require_once 'connect.php';

$errors = [];

if (isset($_COOKIE['username'])) {
    header('Location: homepage.php');
} else if (isset($_SESSION['username'])) {
    header('Location: homepage.php');
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);
    dd($_POST);
    try {
        $sql = "select USERNAME,PASSWORD from USERS";
        $result = $conn->query($sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        dd($row);
        $password=sha1($password);
        $check = false;
        foreach ($row as $value) {
            if (($value['USERNAME'] === $username) && ($value['PASSWORD'] === $password)) {
                $check = true;
                header('Location: homepage.php');
            }
        }
        if ($check === false) {
            echo '<div class="alert alert-success" role="alert">
                username or password wrong!
            </div>';
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="background">
        <section class="vh-100 gradient-custom">
            <form action="" method="post">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                        <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="username" id="username" name="username" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" />
                                        </div>

                                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot
                                                password?</a></p>

                                        <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                            name="login">Login</button>

                                        <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                            <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                            <a href="#!" class="text-white"><i
                                                    class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                            <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                        </div>

                                    </div>

                                    <div>
                                        <p class="mb-0">Don't have an account? <a href="register.php"
                                                class="text-white-50 fw-bold">Sign Up</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>

</html>