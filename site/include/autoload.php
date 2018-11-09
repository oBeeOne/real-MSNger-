<?php
/**
 *  Autoloader des fichiers requis pour charger les fonctions nécessaires à l'application
 */

 // fonction d'appel de fichiers

 function autoload($array){
     // Pour chaque élément du tableau des noms de fichiers
     foreach($array as $f){
         // La fonction stream_resolve_include_path() permet de vérifier le chemin exaxt du fichier
         $file = stream_resolve_include_path($f.".php");
         
         // Si le fichier existe...
         if(file_exists($file)){
             // ...on le charge en mémoire
             require_once($file);
         }
         else{
             // Sinon on affiche une erreur
            echo "<pre>Le fichier requis ".$file." n'existe pas dans les chemins indiqués !</pre>";
         }
     }
 }

?>