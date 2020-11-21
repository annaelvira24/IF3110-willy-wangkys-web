<?php
    include "connectDatabase.php";

    $message_err = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['register'])) {
            if(!empty($_POST['username-regist']) and !empty($_POST['email']) and !empty($_POST['password-regist']) and !empty($_POST['confirm-password'])) {
                if(($_POST['password-regist'] === $_POST['confirm-password'])) {
                    $registeredUsn = $_POST['username-regist'];
                    $registeredEmail = $_POST['email'];
                    $registeredPassword = $_POST['password-regist'];
                    $confirmPassword = $_POST['confirm-password'];
    
                    $queryUsername = "SELECT * FROM users WHERE username = '$registeredUsn'";
                    $queryEmail = "SELECT * FROM users WHERE email = '$registeredEmail'";
                    $queryUsernameSQL = mysqli_query($conn, $queryUsername);
                    $queryEmailSQL = mysqli_query($conn, $queryEmail);
    
                    if(mysqli_num_rows($queryUsernameSQL) == 0 and mysqli_num_rows($queryEmailSQL) == 0) {
                        $hashUsername = md5($username);
                        $rnd = bin2hex(random_bytes(5));
                        $r = str_shuffle($hashUsername . $rnd);
        
                        $insertQuery = "INSERT INTO users(`username`, `email`, `pass`, `category`, `token`) VALUES('$registeredUsn', '$registeredEmail', '$registeredPassword', 'user', '$r')";
                        $insertQuerySQL = mysqli_query($conn, $insertQuery);
    
                        setcookie('tokenized', $r, time()+300);
                        header('Location: dashboard.php');
                    }
                }
                else {
                    $message_err = 'Password and confirm password doesnt match';
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Register Page</title>
        <link rel="stylesheet" type="text/css" href="../css/accountPage.css">
        <script src="../js/registerAccount.js"></script>
    </head>

    <body>
        <h1 class="company-name">Willy Wangky Choco Factory</h1>

        <section id="register-form">
            <form method="POST">
                <label class="label-wrapper">Username</label>
                <input type="text" id="uname" name="username-regist" class="input-form-wrapper" onblur="checkUsername()" required>
                <i><label id="username-err"></label></i>

                <label class="label-wrapper">Email</label>
                <input name="email" id="email" class="input-form-wrapper" onblur="checkEmail()"/ required>
                <i><label id="email-err"></label></i>

                <label class="label-wrapper">Password</label>
                <input type="password" name="password-regist" class="input-form-wrapper" required>

                <label class="label-wrapper">Confirm Password</label>
                <input type="password" name="confirm-password" class="input-form-wrapper" required>

                <label class="label-wrapper"> <?php echo $message_err?> </label>
                
                <input type="submit" value= "Register" class="submit-btn" name="register">
            </form>
        </section>
    </body>

</html>