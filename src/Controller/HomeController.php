<?php

namespace App\Controller;

use App\Repository\MoveRepository;
use App\Repository\PokemonRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        TypeRepository $typeRepository,
        PokemonRepository $pokemonRepository,
        MoveRepository $moveRepositorye
    ): Response {
        return $this->render('home/index.html.twig', [
            'types'    => $typeRepository->findAll(),
            'pokemons' => $pokemonRepository->findAll(),
            'moves'    => $moveRepositorye->findAll(),
        ]);
    }
}
