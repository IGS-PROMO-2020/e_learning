
<?php 
include 'header.php';
include 'database.php';


if (isset($_POST['register'])){
   
    $nom_prenom = htmlspecialchars($_POST['nom_prenom']);
    $password = sha1($_POST['password']);
    $password_confirm = sha1($_POST['confirm_password']);
    $email = htmlspecialchars($_POST['email']);
    $filiere = htmlspecialchars($_POST['Filiere']);
    $niveau = htmlspecialchars($_POST['Niveau']);
    $photo = $_FILES['photo']['name'];
    $fichierTemporaire=$_FILES['photo']['tmp_name'];
    move_uploaded_file($fichierTemporaire,'./images/'.$photo);
    
 
    if ((!empty($nom_prenom)) && (!empty($password_confirm)) && (!empty($password)) && (!empty($filiere)) && (!empty($niveau)) && (!empty($email)) && (!empty($photo))) {
        if (strlen($nom_prenom) <= 40){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password == $password_confirm) {
 
                    $database = getPDO();
                    $rowEmail = countDatabaseValue($database, 'email', $email);
                    if ($rowEmail == 0) {
                        $rowPseudo = countDatabaseValue($database, 'nom_prenom', $nom_prenom);
                        if ($rowPseudo == 0) {
                            $insertMember = $database->prepare("INSERT INTO Etudiant(nom_prenom, password, Filiere, email, Niveau, avatar) VALUES(?, ?, ?, ?, ?, ?)");
                            $insertMember->execute([
                                $nom_prenom,
                                $password,
                                $filiere,
                                $niveau,
                                $email,
                                $photo,
                            ]);
                            $succesMessage = "merci encore !";
                            header('location:confirmation_de_compte.php');
                        } else {
                            $errorMessage = 'Cette nom est déjà utilisée..';
                        }
                    } else {
                        $errorMessage = 'Cette email est déjà utilisée..';
                    }
                } else {
                    $errorMessage = 'Les mots de passes ne correspondent pas...';
                }
            } else {
                $errorMessage = "Votre email n'est pas valide...";
            }
        } else {
            $errorMessage = 'Le pseudo est trop long...';
        }
    } else {
        $errorMessage = 'Veuillez remplir tous les champs...';
    }
}
 
?>


<div class="container">
<br> 
<hr>


<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 600px;">
	<h4 class="card-title mt-3 text-center">Veuillez vous inscrire!!</h4>
	
	<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="nom_prenom" class="form-control" placeholder="Full name" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email">
    </div> <!-- form-group// -->

    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select class="form-control" name="Niveau" >
			<option selected="" > Niveau</option>
			<option>BTS</option>
			<option>Licence</option>
            <option>Master</option>
            <option>Doctorat</option>
		</select>
	</div> <!-- form-group end.// -->
    
    
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select class="form-control"  name="Filiere">
			<option selected=""> filière</option>
			<option>RHcom</option>
			<option>Informatique</option>
            <option>Mine et Geologie</option>
            <option>Fcge</option>
		</select>
	</div> <!-- form-group end.// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="password" name="password">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Repeat password" type="password" name="confirm_password">
    </div> <!-- form-group// --> 
    
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class=""></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="file" name="photo">
    </div> <!-- form-group// -->


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"  name="register"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

