<?php

//Nous
//changer le .htaccess
//enlever ip local de config.php

/* Prof
  Dans web/app_dev.php, ajouter son ip dans REMOTE_ADDR
  Configurer app/parameters.yml
 */

// web/app_dev.php

/* if (!in_array(@$_SERVER['REMOTE_ADDR'], array(
  '127.0.0.1',
  '::1'
  ))) {
  header('HTTP/1.0 403 Forbidden');
  exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
  } */
echo "Installation de l'application Caesar....\n";
echo "Verifiction des pre-requis...\n";
/* if (!extension_loaded("fileinfo")) {
  exit("ERREUR: Veuillez activer le module php_fileinfo");
  }
  if (!extension_loaded("gd")) {
  exit("ERREUR: Veuillez activer le module gd2");
  }
  if (!extension_loaded("intl")) {
  exit("ERREUR: Veuillez activer le module intl");
  }
  if (!extension_loaded("php_openssl")) {
  exit("ERREUR: Veuillez activer le module php_openssl");
  } */
/* cache */
//exec("php app\console cache:clear");
//exec("php app\console cache:clear --env=prod");

/* Vendors
  Si Composer, composer.json et composer.lock. exécutez la commande php composer.phar install.
  Si pas, alors envoyer le dossier vendor */
//echo "Vendors...\n";
echo "Initialisation...\n";
exec("php composer.phar install");
echo "Vendors ok\n";

echo "Mise à jours des droits d'acces...\n";
//chmod 777

if (file_exists("app\cache")) {
    chmod("app\cache", 0777);
}
if (file_exists("app\logs")) {
    chmod("app\logs", 0777);
}
if (file_exists("Adminbundle\Resouces\config\params.yml")) {
    chmod("Adminbundle\Resouces\config\params.yml", 0777);
}
echo "Droits d'acces ok \n";

/* db */
echo "Initialisation de la base de donnees...\n";
exec("php app\console doctrine:database:create");
exec("php app\console doctrine:schema:update --force");
echo "Base de donnees ok\n";

/* assets */
echo "Creation des liens...\n";
exec("php app\console assets:install web --symlink");

/* cache */
echo "Nettoyage du cache...\n";
exec("php app\console cache:clear");
exec("php app\console cache:clear --env=prod");

echo "L'installation c'est deroule avec succes."
/* Extensions à activer a vérifier */
?>
