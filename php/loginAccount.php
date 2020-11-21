<?php
    include "connectDatabase.php";

    if(isset($_COOKIE['tokenized']) and !isset($_POST['login'])) {
        $tokenCookie = $_COOKIE['tokenized'];
        $check = "SELECT * FROM users WHERE token = '$tokenCookie'";
        $checkSQL = mysqli_query($conn, $check);
        if(mysqli_num_rows($checkSQL) != 0) {
            header('Location: dashboard.php');
        }
    }

    else {
        $message_err = '';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['login'])) {
                if(!empty($_POST['email']) and !empty($_POST['pw'])) {
                    $inputEmail = $_POST['email'];
                    $inputPw = $_POST['pw'];

                    $q = "SELECT id_user, username, email, pass FROM users WHERE email = '$inputEmail'";
                    $result = mysqli_query($conn, $q);

                    if(mysqli_num_rows($result) != 0) {
                        list($id_user, $username, $email, $pass) = mysqli_fetch_array($result);
                        if($pass == $inputPw) {
                            $hashUsername = md5($username);
                            $rnd = bin2hex(random_bytes(5));
                            $r = str_shuffle($hashUsername . $rnd);
                            $updateQuery = "UPDATE users SET token = '$r' WHERE email = '$email'";
                            $updateQuerySQL = mysqli_query($conn, $updateQuery);
                            if(!$updateQuerySQL) {
                                echo(mysqli_error($conn));
                            }


                            setcookie('tokenized', $r, time()+300);
                            header('Location: dashboard.php');
                        }
                        else {
                            $message_err = 'Wrong password!';
                        }
                    }   
                    else {
                        $message_err = 'Wrong email!';
                    }  
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="../css/accountPage.css">
        <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
    </head>

    <body>
        <h1 class="company-name">Willy Wangky Choco Factory</h1>

        <section id="login-form">
            <form method="POST" action="">
                <label class="label-wrapper">Email</label>
                <input type="text" name="email" class="input-form-wrapper" required>

                <label class="label-wrapper">Password</label>
                <input type="password" name="pw" class="input-form-wrapper" required>
                
                <label class="label-wrapper"> <?php echo $message_err?> </label>

                <input type="submit" value= "Login" class="submit-btn" name="login">
            </form>
        </section>

        <input type="submit" value="Register Account" class="register-btn" name="register" onclick="location.href = 'registerAccount.php';">

    </body>

</html>