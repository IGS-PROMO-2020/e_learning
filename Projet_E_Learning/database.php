<?php
    /**
     * Connexion à la base de données.
     */
    function getPDO() {
        try {
            $pdo = new PDO('mysql:dbname=e_learning;host=127.0.0.1', 'root', '');
            $pdo->exec("SET CHARACTER SET utf8");
            return $pdo ;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
 
    function countDatabaseValue($connexionBDD, $key, $value) {
        $request = "SELECT * FROM etudiant WHERE $key = ?";
        $rowCount = $connexionBDD->prepare($request);
        $rowCount->execute(array($value));
        return $rowCount->rowCount();
    }

    ?>