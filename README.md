## (--- Attention en cours de développement ! ---)

# Le Quai Antique

## Présentation

Le Quai Antique est un projet Open-Source, l'idée est de créer une **application Web vitrine** pour le Chef Arnaud Michant, qui a décidé d'ouvrir son troisième restaurant.

## Installation
Exécutez d'abord ces commandes pour récuperer les fichiers:


```
$ git clone https://github.com/guillaume13880/symfony1.git
$ cd symfony1/

```
Assurez vous d'avoir les bonnes versions de Composer (2.5.5) et de Php (8.0). Pour vérifier :

```
$ composer --version
$ php --version

```
Il nous faut installer le projet avec composer. Vous pouvez exécuter cette commande afin de pouvoir exploiter le projet en ligne de commande :
```
$ composer install

```
Vous pouvez enfin exécuter la commande suivante pour voir la liste des commandes disponibles :
```
$ php bin/console

```
Pour lancer un serveur php, exécuter la commande suivante (pré-requis : Symfony CLI):
```
$ symfony server:start

```
Lancez enfin votre projet.

Lien : http://127.0.0.1 ou http://localhost

Pour mettre en place votre base de données, créez une fichier .env.local avec comme variable d'environnement :

```
DATABASE_NAME=symfony1
DATABASE_HOST=localhost
DATABASE_PORT=3306
DATABASE_USER=!ChangeMe!
DATABASE_PASSWORD=!ChangeMe!

DATABASE_URL="mysql://USER:PASSWORD@HOST:3306/DBNAME?serverVersion=8.0"

```
Une fois les variables initialisées, vous pouvez commencer à créer la base de données :
```
$ php bin/console doctrine:database:create
$ php bin/console make:migration
$ php bin/console doctrine:migration:migrate

```
Nous allons maintenant générer les fixtures :
```
$ php bin/console doctrine:fixtures:load
$ yes

```
Et voilà ! Vous pouvez enfin lancer le projet et commencer à travailler !

## Connexion au site

Vous pouvez dès à présent vous connecter avec un compte administrateur :

* Identifiant : `admin@quai-antique.fr`
* Mot de passe : `passpass`

Ou un faux compte utilisateurs créer en base de données) :

* Identifiant : `(Récuperer une adresse email créer en BDD)`
* Mot de passe : `password`
