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

        $get_pokemon_var = max(0, $request->query->getInt('get_pokemon', 0));
        if($get_pokemon_var == 1){
            return $this->get_pokemon_list($pokemonRepository); 
        }

        return $this->render('home/index.html.twig', [
            'pokemons' => $paginator,
            'previous' => $offset - PokemonRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + PokemonRepository::PAGINATOR_PER_PAGE),
        ]);
    }

    protected function get_pokemon_list($pokemonRepository){

        $new_page_to_show = $pokemonRepository->getSpecificPokemon(50+18);
        return $this->render('home/index.html.twig', [
            'pokemons' => $new_page_to_show,
            'previous' => 50 - PokemonRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($new_page_to_show), 50 + PokemonRepository::PAGINATOR_PER_PAGE),
        ]);
    }
}
