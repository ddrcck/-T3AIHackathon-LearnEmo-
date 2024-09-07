<?php

    include("config.php");

    if(isset($_POST['submit'])){
        $name=mysqli_real_escape_string($database,$_POST['name']);
        $email=mysqli_real_escape_string($database,$_POST['email']);
        $passwrd=mysqli_real_escape_string($database,$_POST['password']);
        $cpasswrd=mysqli_real_escape_string($database,$_POST['controlpassword']);

        /*to check if user exist */
        $select = " SELECT * FROM user WHERE email ='$email'&& password ='$passwrd' ";

        $result = mysqli_query($database, $select);
        if(mysqli_num_rows($result) > 0){

         $error[] = 'User already exist!';

        }else{/*check password and cpassword is same or not*/
            if($passwrd != $cpasswrd){
                $error[] = ' password do not match!';
            }
            else{/*if user not in our data base and have matched pasword so we can inser*/

                $insert = "INSERT INTO user (name,email, password) VALUES ('$name','$email','$passwrd')";
                mysqli_query($database, $insert);
                header('location:login.php');
            }

        }
    };

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kayıt Ol</title>
        <link rel="stylesheet" href="styles/user.css?v=1.0">
    
    </head>
    <body>
    <div class="balloon-container">
            <div class="balloon"></div>
            <div class="balloon"></div>
            <div class="balloon"></div>
            <div class="balloon"></div>
            <div class="balloon"></div>
            <div class="balloon"></div>
        </div>
        <div class="container-form">
            <img class="logo" src="images/register.gif">
            <form action="" method="post">
                <h1>Kayıt ol</h1>
                <?php
                if (isset($error)) {
                    foreach($error as $error){
                        echo '<span class="error-msg">' . $error . '</span>';

                    };


                };
                
                ?>
                
                <input type="text" name="name" placeholder="İsim" required>
                <input type="email" name="email" placeholder="mail" required>
                <input type="password" name="password" placeholder="şifre" required>
                <input type="password" name="controlpassword" placeholder="şifrenizi doğrulayın " required>
            
                <input class="btn" type="submit" name="submit" value="Kayıt ol">
                <p>Hesabınız var mı? <a href="login.php">Giriş yapın</a></p>
            </form>


        </div>




    </body>

</html>