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
