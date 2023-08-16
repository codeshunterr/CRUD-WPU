<?php
session_start();
require "function.php";
if (isset($_COOKIE["id"]) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = $email");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['email'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_COOKIE['login'])) {
    if ($_COOKIE['login'] == 'true') {
        $_SESSION['login'] = true;
    }
}


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST["remember"])) {

                setcookie('id', $row['id'], time() + 1);
                setcookie('key', hash('sha256', $row['email']), time() + 60);
            }
            header("Location: index.php");
            exit;
        } else {
            echo "<script> alert('password tidak sesuai')</script>";
        }
    } else {
        echo "<script> alert('username tidak ada')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" type="text" name="email" />
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" type="password" name="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" name="login" class="btn btn-primary">login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>