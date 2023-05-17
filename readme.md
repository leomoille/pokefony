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

Exécutez ensuite les migrations :

```shell
symfony console d:m:m
```

Pour finir, lancez les fixtures (cette opération récupère les informations des Pokémon depuis PokéAPI et peu donc
prendre un certain temps ) :

```shell
symfony console d:f:l
```
