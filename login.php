<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <?php
    session_start();
    include 'connect.php';
    ?>
</head>
<style>
    body {
        margin-top: 30px;
        margin-left: 30px;
    }

    .form-control {
        width: 600px;
        margin-top: 10px;
        margin-bottom: 10px;
        border-color: #ccc;
    }

    label {
        font-weight: bold;
        font-size: 18px;
    }

    .btn-primary,
    .btn-primary:hover,
    .btn-primary:active,
    .btn-primary:visited {
        background-color: #4CAF50 !important;
        border-color: #4CAF50 !important;
        width: 600px;
        height: 45px;
    }

    .login {
        width: 650px;
        height: 330px;
    }

    h2 {
        font-size: 30px;
        margin-left: -130px;
    }

    label {
        margin-left: -510px;
    }
</style>

<body>

    <center>
        <div class="login form-control">
            <div class="container-fluid mt-3">
                <h2>LOGIN PAGE PRODUCT MANAGER</h2>

                <form method="POST" action="" id="form-1">
                    <!-- Vertical -->
                    <div class="form-group">
                        <label for="myEmail">Username</label>
                        <input type="email" id="myEmail" name="txtemail" class="form-control" placeholder="Enter Username">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="myPassword">Password</label>
                        <input type="password" id="myPassword" name="txtpass" class="form-control" placeholder="Enter Password">
                        <span class="form-message"></span>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login"> Login</button>
                </form>

                <?php
                mysqli_query($conn, 'SET NAMES UTF8');
                if (isset($_POST['login'])) {
                    if (empty($_POST['txtemail']) or empty($_POST['txtpass'])) {
                        echo '<br> <p style="color: red; font-size: 20px;"> Tài khoản hoặc mật khẩu không hợp lệ </p>';
                    } else {
                        $email = $_POST['txtemail'];
                        $pass = md5($_POST['txtpass']);
                        $query = "SELECT * FROM account WHERE email = '$email' and pass = '$pass'";
                        $res = mysqli_query($conn, $query);
                        $num = mysqli_num_rows($res);
                        if ($num == 0) {
                            echo '<br> <p style="color: red; font-size: 20px;"> Tài khoản hoặc mật khẩu không chính xác </p>';
                        } else {
                            $_SESSION['email'] = $email;
                            header('location:index.php');
                        }
                    }
                }
                ?>

            </div>
        </div>
    </center>

    <script src="./main.js"></script>
    <script>
        // Mong muốn của chúng ta
        Validator({
            form: '#form-1',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isEmail('#myEmail'),
                Validator.minLength('#myPassword', 6),
                Validator.kytudacbiet('#myPassword'),
                Validator.isNumber('#myPassword'),
            ],
            // onSubmit: function (data) {
            //   // Call API
            //   console.log(data);
            // }
        });
    </script>

</body>

</html>