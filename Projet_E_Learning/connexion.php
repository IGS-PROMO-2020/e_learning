<?php
 
include 'connect_bd.php';
 
if (isset($_POST['submit'])) {
 
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
 
    if ((!empty($email)) && (!empty($password))) {
 
        
        $requestUser = $bdd->prepare("SELECT * FROM etudiant WHERE email = ? AND password = ?");
        $requestUser->execute(array($email, $password));
        $userCount = $requestUser->rowCount();
        if ($userCount == 1) {
            
            session_start();
            $userInfo = $requestUser->fetch();
            $_SESSION['userID'] = $userInfo['id'];
            $_SESSION['userPseudo'] = $userInfo['pseudo'];
            $_SESSION['userPassword'] = $userInfo['Password'];
            $_SESSION['userFirstname'] = $userInfo['Firstname'];
            $_SESSION['userLastname'] = $userInfo['Lastname'];
            $_SESSION['userEmail'] = $userInfo['Email'];
            $_SESSION['usercontact'] = $userInfo['contact'];
            $_SESSION['userAvatar'] = $userInfo['avatar'];
            $_SESSION['userStatus'] = $userInfo['status'];

            if ($_SESSION['userStatus'] == 0) {

                $succesMessage = 'Bravo, vous êtes maintenant connecté !';
                header('refresh:3;url=index.php');
            }else {
                $succesMessage = 'Bravo, vous êtes maintenant connecté !';
                header('refresh:3;url=dash/Admin_queen/index.php');
            }
            
        }
    }
}
 
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Espace Client - Connexion</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        
    <div class="signin">
    
            <?php if (isset($errorMessage)) { ?> <p style="color: red;"><?= $errorMessage ?></p> <?php } ?>
            <?php if (isset($succesMessage)) { ?> <p style="color: green;"><?= $succesMessage ?></p> <?php } ?>

            <h2 style="color:#fff;">Connexion</h2>

            <form method="post" action="">

                <input type="email" name="email" placeholder="Email"><br>

                <input type="password" name="password" placeholder="Mot de passe"><br><br>
 
                <input type="submit" name="submit" value="Se connecter">
            </form>
        </div>
    </body>
    