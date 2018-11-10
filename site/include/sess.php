<?php

/**
 * Gestion de la session, des cookies et des variables de session
 * 
 */

 $sess_timeout = 300;

 /**
  * Démarrage de la session
  */
  function sess_demarrer(){
      session_start();
      $sessid = session_id().microtime().rand(0,999999999);
      $sessid = hash('sha-256', $sessid);
      setcookie('g_ta', $sessid, time()+(60*5));
      $_SESSION['g_ta'] = $sessid;

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
               session_unset();
               session_destroy();
               header('location:index.php');
           }
           else{
               $_SESSION['starttime'] = time();
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