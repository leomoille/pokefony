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
        $pokemon_searched = '';
        if($request->query->get('pokemon_searched') != null){
            $pokemon_searched = $request->query->get('pokemon_searched');
        }
        
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $pokemonRepository->getPokemonPaginator($offset, $pokemon_searched);

        $pokemon_var_name = $request->query->get('get_pokemon');
        if($pokemon_var_name == 1){
            $pokemons_list = $pokemonRepository->findByNameField('bulbasaur');
            dd($pokemons_list);
            
        }
        

        return $this->render('home/index.html.twig', [
            'pokemon_search' => $pokemon_searched,
            'pokemons' => $paginator,
            'previous' => $offset - PokemonRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + PokemonRepository::PAGINATOR_PER_PAGE),
        ]);
    }

    protected function get_search_pokemon(Request $request, PokemonRepository $pokemonRepository){

    }

}
