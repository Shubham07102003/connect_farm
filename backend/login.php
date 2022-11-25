<?php

require 'autoloader.php'; // automatically get classes name


// // Fix for removed Session functions
// function fix_session_register()
// {
//     function session_register()
//     {
//         $args = func_get_args();
//         foreach ($args as $key) {
//             $_SESSION[$key] = $GLOBALS[$key];
//         }
//     }
//     function session_is_registered($key)
//     {
//         return isset($_SESSION[$key]);
//     }
//     function session_unregister($key)
//     {
//         unset($_SESSION[$key]);
//     }
// }
// if (!function_exists('session_register')) fix_session_register();
?>

<?php
$error = "";
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT id FROM `_users` WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        // session_register("myusername");
        $_SESSION['login_user'] = $myusername;

        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <style>
        label {
            font-weight: bold;
            width: 100px;
            font-size: 14px;
        }

        canvas {
            position: fixed;
            z-index: 0;
            opacity: 0.85;
        }

        form {
            background-color: white;
            position: absolute;
            padding: 30px;
        }

        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-image: linear-gradient(120deg, #3498db, #8e44ad);
        }

        .login-form {
            width: 360px;
            background: #ffffff;
            height: min-content;
            padding: 50px;
            border-radius: 10px;
            position: absolute;
            left: 50%;
            top: 40%;
            transform: translate(-50%, -50%);
        }

        .login-form h1 {
            text-align: center;
            margin-bottom: 60px;
        }

        .txtb {
            border-bottom: 2px solid #adadad;
            position: relative;
            margin: 30px 0;
        }

        .txtb input {
            font-size: 15px;
            color: #333;
            border: none;
            width: 100%;
            outline: none;
            background: none;
            padding: 0 5px;
            height: 40px;
        }

        .txtb span::before {
            content: attr(data-placeholder);
            position: absolute;
            top: 50%;
            left: 5px;
            color: #a8a8a8;
            transform: translateY(-50%);
            z-index: -1;
            transition: .5s;
        }

        .txtb span::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background: linear-gradient(120deg, #3498db, #8e44ad);
            transition: .5s;
            top: 100%;
            left: 0;
        }

        .focus+span::before {
            top: -5px;
        }

        .focus+span::after {
            width: 100%;
        }

        .logbtn {
            display: block;
            width: 100%;
            height: 50px;
            border: none;
            background: linear-gradient(120deg, #3498db, #8e44ad, #3498db);
            background-size: 200%;
            color: #fff;
            outline: none;
            cursor: pointer;
            transition: .5s;
            font-size: large;
            font-weight: 700;
        }

        .logbtn:hover {
            background-position: right;
        }

        .bottom-text {
            margin-top: 60px;
            text-align: center;
            font-size: 13px;
        }
    </style>
    <!-- Compiled and minified JavaScript -->
    <script src="js/jquery.js" charset="utf-8"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<div class="trail">

    <canvas id="world" width="366" height="626"></canvas></div>

<body>

<form action="" class="login-form" method="POST">
    <h1>Login</h1>

    <div class="txtb">
        <input type="text" name="username">
        <span data-placeholder="Username"></span>
    </div>

    <div class="txtb">
        <input type="password" name="password">
        <span data-placeholder="Password"></span>
    </div>

    <input type="submit" class="logbtn" value="Login">

    <div style="color:red;font-size:15px;font-weight:700;margin-top:15px;"><?php echo $error; ?></div>
</form>

<script type="text/javascript">
    $(".txtb input").on("focus", function() {
        $(this).addClass("focus");
    });

    $(".txtb input").on("blur", function() {
        if ($(this).val() == "")
            $(this).removeClass("focus");
    });
</script>
<script src = "js/trail.js">


</script>

</body>

</html>