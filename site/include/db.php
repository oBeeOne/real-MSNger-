<?php

// Fonction de connexion à la BDD avec PDO

function db_connect($params){
    try{
        $connect = new PDO($params['database']['dsn'], $params['database']['user'], $params['database']['password'])
        or die('Erreur de connexion à la base de données !');
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $connect;
    }
    catch(PDOException $e){
            throw new Exception($e->getMessage());
    }

}

?>