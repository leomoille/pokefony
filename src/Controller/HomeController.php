<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(Request $request, PokemonRepository $pokemonRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $pokemonRepository->getPokemonPaginator($offset);

        return $this->render('home/index.html.twig', [
            'pokemons' => $paginator,
            'previous' => $offset - PokemonRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + PokemonRepository::PAGINATOR_PER_PAGE),
        ]);
    }
}
