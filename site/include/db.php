<?php

/**
 * Fonction de connexion à la BDD avec PDO
 * 
 * @param type array
 * @return type object pdo
 * 
 */
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

/**
 *  Définition des "Getters" dans la BDD
 */

 /**
  * Récupération des données d'un utilisateur
  * 
  * @param type object pdo
  * @param type array 
  * @return type array
  *
  */
function db_get_user($db_object, $params){
    // code...
}

 /**
 * Récupération de la vue contenant les 10 derniers messages du chat
 * 
 * @param type object pdo
 * @return type object pdo query resultset
 * 
 */
 function db_get_messages($db_object){
    // code
 }

 /**
  * Définition des "Setters" dans la BDD
  */
  
  /**
   * Enregistrement d'un utilisateur dans la BDD
   * 
   * @param type object pdo
   * @param type array
   * @return type boolean
   * 
   */
  function db_set_user($db_object, $params){
      // code
  }

  /**
   * Enregistrement d'un nouveau message dans la table buffer
   * 
   * @param type object pdo
   * @param type array
   * @return type boolean
   * 
   */
  function db_set_nouveau_message($db_object, $msg){
      // code
  }



?>