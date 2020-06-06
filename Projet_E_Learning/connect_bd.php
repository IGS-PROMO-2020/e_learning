<?php 
  
    // If form submitted, insert values into the database.
    try{
      $bdd = new PDO('mysql:host=127.0.0.1;dbname=e_learning', 'root', '');
      $con = mysqli_connect('localhost', 'root', '');
      mysqli_select_db($con, 'e_learning');

      // Activation des erreurs PDO  
       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
       $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } 
       catch(PDOException $e) {
          echo 'connection failed: ' or die('Erreur : ' . $e->getMessage());
      }


     
      ?>