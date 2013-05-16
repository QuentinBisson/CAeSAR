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
echo "Verification des pre-requis...\n";
if (!extension_loaded("fileinfo")) {
    exit("ERREUR: Veuillez activer le module fileinfo");
}
if (!extension_loaded("gd")) {
    exit("ERREUR: Veuillez activer le module gd");
}
if (!extension_loaded("intl")) {
    exit("ERREUR: Veuillez activer le module intl");
}
if (!extension_loaded("openssl")) {
    exit("ERREUR: Veuillez activer le module openssl");
}
if (!extension_loaded("PDO")) {
    exit("ERREUR: Veuillez activer le module PDO");
}
if (!extension_loaded("mysqli")) {
    exit("ERREUR: Veuillez activer le module mysqli");
}
if (!extension_loaded("mysql")) {
    exit("ERREUR: Veuillez activer le module mysql");
}
if (!extension_loaded("pdo_mysql")) {
    exit("ERREUR: Veuillez activer le module pdo_mysql");
}

echo "Initialisation...\n";
exec("php composer.phar install");
echo "Vendors ok\n";

echo "Mise a jour des droits d'acces...\n";
//chmod 777

if (file_exists("app/cache")) {
    chmod("app/cache", 0777);
}
if (file_exists("app/logs")) {
    chmod("app/logs", 0777);
}
if (file_exists("Adminbundle/Resouces/config/params.yml")) {
    chmod("Adminbundle/Resouces/config/params.yml", 0777);
}
echo "Droits d'acces ok \n";

/* db */
echo "Initialisation de la base de donnees...\n";
exec("php app/console doctrine:database:create");
exec("php app/console doctrine:schema:update --force");
exec("php app/console doctrine:fixtures:load --fixtures=src/Caesar/AdminBundle/DataFixtures/ORM --append");
echo "Base de donnees ok\n";

/* assets */
echo "Creation des liens...\n";
exec("php app/console assets:install web --symlink");

/* cache */
echo "Nettoyage du cache...\n";
exec("php app/console cache:clear");
exec("php app/console cache:clear --env=prod");

echo "L'installation s'est deroulee avec succes."
?>
