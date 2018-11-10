<?php

/**
 * Gestion de la session, des cookies et des variables de session
 * 
 */

 /**
  * Fonctions de sécurisation à appeler dans les autres fonctions de session
  *
  */
  function sess_securite(){
      if(isset($_SESSION)){
          $sessid = session_id().microtime().rand(0,999999999);
          $sessid = hash('sha256', $sessid, FALSE);
          if(!isset($_COOKIE['g_ta'])){
              setcookie('g_ta', $sessid, time()+300);
          }
          else{
              $_COOKIE['g_ta'] = $sessid;
          }
          $_SESSION['g_ta'] = $sessid;
      }
  }

  function sess_verif_securite(){
      if(isset($_SESSION)){
          if(isset($_COOKIE['g_ta']) == isset($_SESSION['g_ta'])){
              sess_securite();
          }
          else{
              sess_fin();
          }
      }
  }

 /**
  * Démarrage de la session
  */
  function sess_demarrer(){
      session_start();
      sess_securite();

      return true;
  }

  /**
   * Vérification du temps de session, si supérieur au time out, on ferme la session
   * 
   * @param type int temps en secondes
   */

   function sess_timeout($temps_limite){
       if(isset($_SESSION['starttime'])){
           $starttime = $_SESSION['starttime'];
           $duree = time()-$starttime;

           if($duree > $temps_limite){
               session_fin();
           }
           else{
               $_SESSION['starttime'] = time();
               sess_securite();
           }
       }
       else{
        $_SESSION['starttime'] = time();
       }
   }

   /**
    * Fin de session (deconnexion de l'utilisateur)
    */

    function sess_fin(){
        session_unset();
        session_destroy();
        header('location:index.php');
    }



?>