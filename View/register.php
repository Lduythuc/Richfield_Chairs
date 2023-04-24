<?php
require_once 'utils.php';
require_once 'connect.php';
$errors = [];

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = sha1($_POST['password']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    if (empty($username)) {
        $errors[] = 'Username is required';
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    }
    if (empty($phone)) {
        $errors[] = 'Phone is required';
    }
    if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
        $errors[] = 'Phone must be 10 or 11 digits';
    }
    if (empty($address)) {
        $errors[] = 'Address is required';
    }
    if (empty($role)) {
        $role='1';
    }

    if (count($errors) === 0) {
        try {
            $sql = "INSERT INTO USERS (USERNAME, PASSWORD, FULLNAME, EMAIL, PHONE, ADDRESS, ROLE) VALUES ('$username', '$password', '$fullname', '$email', '$phone', '$address', '$role')";
            $res = $conn->query($sql);
            // insert successfully
            if ($res) {
                echo 'Register successfully';
                die();
            }
        } catch (Exception $ex) {
            // echo $ex->getCode();
            // echo $ex->getMessage();
            if ($ex->getCode() === 1062) {
                $errors[] = 'Username already exists';
            }
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<body>
    <section class="register-box">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center text-primary">Register</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group mb-2">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Enter your username" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="fullname">Full name</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control"
                                        placeholder="Enter your name" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter your password" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email">Phone</label>
                                    <input type="tel" pattern="^[0-9]{10,11}$"
                                        title="Phone number must be 10 or 11 digits" name="phone" id="phone"
                                        class="form-control" placeholder="Enter your phone" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Enter your address" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="role">Role: </label>
                                    <input type="radio" name="role" value="0"> yes
                                    <input type="radio" name="role" value="1"> no
                                </div>
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <a href="login.php" class="text-uppercase fw-bold">Login</a>
                                    <input type="submit" name="register" value="register" class="btn btn-primary">
                                </div>
                                <?php
                                if (count($errors) > 0) {
                                    echo "<div class='alert alert-danger'>";
                                    foreach ($errors as $error) {
                                        echo "<li>$error</li>";
                                    }
                                    echo "</div>";
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>