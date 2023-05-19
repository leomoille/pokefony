# PokéFony

Un projet de Pokédex simple de la première génération du jeu Pokémon.

## Installation du projet

Une fois le projet récupéré, installez les dépendances :

```shell
composer install
```

Lancer également Docker :

```shell
docker compose up -d
```

*N'oubliez pas d'activer `pdo_pgsql` dans votre fichier `php.ini`.*

Exécutez ensuite les migrations :

```shell
symfony console d:m:m
```

Lancez les fixtures (cette opération récupère les informations des Pokémon depuis PokéAPI et peu donc
prendre un certain temps ) :

```shell
symfony console d:f:l
```

Installez ensuite les packages npm :

```shell
npm install
```

Puis lancez la commande suivante pour compiler les styles et le js :

```shell
npm run build
```

----

## Lancer le serveur local

```shell
symfony server:start -d
```
