<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        $pokemons = $pokemonRepository->findAll();

        return $this->render('home/index.html.twig', [
            'pokemons' => $pokemons,
        ]);
    }
}
