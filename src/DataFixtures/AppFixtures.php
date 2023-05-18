<?php

namespace App\DataFixtures;

use App\Entity\Move;
use App\Entity\Pokemon;
use App\Entity\Type;
use App\Repository\MoveRepository;
use App\Repository\TypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpClient\HttpClient;

class AppFixtures extends Fixture
{
    const TYPE_AMOUNT = 20;
    const MOVE_AMOUNT = 920;
    const POKEMON_AMOUNT = 1010;


    public function __construct(
        private TypeRepository $typeRepository,
        private MoveRepository $moveRepository,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $client = HttpClient::create();
        $staticTypes = [];
        $staticMoves = [];

        // Get Types
        $typeRequest = $client->request('GET', 'https://pokeapi.co/api/v2/type');
        $types = json_decode($typeRequest->getContent(), true)['results'];

        for ($i = 0; $i < self::TYPE_AMOUNT; $i++) {
            $type = new Type();
            $type->setName($types[$i]['name']);

            $manager->persist($type);

            $staticTypes[$type->getName()] = $type;
        }

        // Get Moves
        $moveRequest = $client->request('GET', 'https://pokeapi.co/api/v2/move?limit=100000');
        $moves = json_decode($moveRequest->getContent(), true)['results'];

        for ($i = 0; $i < self::MOVE_AMOUNT; $i++) {
            $move = new Move();
            $move->setName($moves[$i]['name']);

            $manager->persist($move);

            $staticMoves[$move->getName()] = $move;
        }

        // Get Pokémon
        for ($i = 1; $i <= self::POKEMON_AMOUNT; $i++) {
            $tryCount = 0;
            do {
                $pokemonRequest = $client->request('GET', "https://pokeapi.co/api/v2/pokemon/$i");
                $tryCount++;
            } while ($pokemonRequest->getStatusCode() == 403 or $tryCount === 10);
            $response = $pokemonRequest->getContent();
            $content = json_decode($response, true);

            $pokemon = new Pokemon();
            $pokemon
                ->setName($content['name'])
                ->setNumber($content['id'])
                ->setHeight($content['height'])
                ->setSprite($content['sprites']['front_default']);


            foreach ($content['types'] as $type) {
                $pokemon->addType($staticTypes[$type['type']['name']]);
            }

            foreach ($content['moves'] as $move) {
                $pokemon->addMove($staticMoves[$move['move']['name']]);
            }

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}
