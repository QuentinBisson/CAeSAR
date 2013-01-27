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

6) Mise à jour des routes
-------------------------
Lorsque vous modifier une route, lancez les commandes suivantes :
    php app/console translation:extract fr --dir=./src/ --output-dir=./app/Resources/translations --enable-extractor=jms_i18n_routing
    php app/console translation:extract en --dir=./src/ --output-dir=./app/Resources/translations --enable-extractor=jms_i18n_routing

Ainsi les routes seront préfixés par la locale en cours.
Exemple : 
    - L'url http://localhost/CAeSAR/web/admin/resource/ ne fonctionne pas
    - L'url http://localhost/CAeSAR/web/en/admin/resource/add est valide

