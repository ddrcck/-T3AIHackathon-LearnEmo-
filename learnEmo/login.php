<?php

    include("config.php");
    session_start();

    if(isset($_POST['submit'])){
       
        $email=mysqli_real_escape_string($database,$_POST['email']);
        $passwrd=mysqli_real_escape_string($database,$_POST['password']);
      
        /*to check if user exist */
        $select = " SELECT * FROM user WHERE email ='$email'&& password ='$passwrd' ";
        $result = mysqli_query($database, $select);
        if (mysqli_num_rows($result) > 0) { /* Kullanıcı tablosundan seçim yap */
            $row = mysqli_fetch_array($result);
            
            // Tek tip kullanıcı bilgilerini oturumda sakla
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
        
            // Kullanıcıyı ana sayfaya yönlendir
            header('location:modül.php'); // Ana sayfanızı belirtin
            exit(); // Yönlendirmeden sonra çıkış yap
            
        } else {
            $error[] = 'You should check your email and password!';
        }
    };

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Giriş Yap</title>
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
            <img class="logo" src="images/login.gif">
            <form action="" method="post">
                <h1>Giriş Yap</h1>
                <?php
                if (isset($error)) {
                    foreach($error as $error){
                        echo '<span class="error-msg">' . $error . '</span>';

                    };


                };
                
                ?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Şifre" required>
                <input class="btn" type="submit" name="submit" value="Giriş yap">
                <p>Henüz hesabınız yok mu? <a href="register.php">Kayıt ol</a></p>
            </form>


        </div>




    </body>

</html>