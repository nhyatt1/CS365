<html>
<head><title>Processing Form</title></head>
<body>
<?php

    REQUIRE 'dbconnect.php';
    dbConnect();
    echo 'You entered: '.$_POST['username'].'<br>';
    echo 'Password: '.$_POST['userPass'];
    $username = $_POST['username'];
    $password = $_POST['userPass'];
        $checkUser = "SELECT * FROM users WHERE username = :username";

        $stmt1 = $pdo->prepare($checkUser);
        $stmt1->bindParam(':username', $username);
        $stmt1->execute();

        $row = $stmt1->fetch();

            if($row){
                //if username exists already:
                echo ('<br>'.'This username already exists.');
            }

            else{
                //if username isn't already taken:
                $sql = 'INSERT INTO users (username, userPass) VALUES (:username, :password)';
                $stmt2 = $pdo->prepare($sql);
                    $username = $_POST['username'];
                    $password = $_POST['userPass'];
                    $encryptedPass = password_hash($password, PASSWORD_BCRYPT);
                    $stmt2->bindParam(':username', $username);
                    $stmt2->bindParam(':password', $encryptedPass);
                    $stmt2->execute();
                    echo '<br>'.'User successfully registered!'
                    //header("Location:");
            }

?>
</body>
</html>
