CAeSAR
======

Installation du projet
========================

1) Clonez le dépôt avec Git
---------------------------

	git clone <repo>

2) Installez les dépendances
----------------------------
Lancez la commande suivante à la racine du projet :

	php composer.phar install

3) Publication des assets
----------------------------
Lancez la commande suivante à la racine du projet :

	php app/console assets:install web --symlink


4) Configuration du projet
--------------------------
Copiez le fichier de configuration `app/config/parameters.yml.dist` et renommez-le en `parameters.yml`.
Modifiez ensuite ce fichier pour l'adapater à la configuration de votre projet.

5) Mise à jour la base de données
---------------------------------
Exécutez les commandes :

	php app/console doctrine:database:create

	php app/console doctrine:schema:create --force

6) Installation de PHPUnit
-------------------------

Tout est au bout de ce lien :

	http://blog.adenova.fr/2009/07/installer-phpunit-sous-wamp/

Pour lancer les tests, executez la commande

	php -c app

A la racine du projet.

7) Module PHP
-------------------------

Pour l'upload de fichier, un validateur necessite l'activation du module
	php_fileInfo
pour récuperer les types mimes des fichiers
(dans wamp, c'est une extension php)

Pour dessiner les codes-barres, il faut activer l'extension gd2

Il faut également activer l'extension intl.

8) Fixtures
-------------------------

Avant de charger les fixtures, il faut faire :

	php composer.phar update
		
Si cela ne fonctionne pas jusqu'au bout, essayez de supprimer votre dossier vendors et de réessayer.

Puis pour charger les fixtures dans la base :

	php app/console doctrine:fixtures:load

9) Droits
-------------------------
chmod a+w src/Caesar/AdminBundle/Resources/config/params.yml