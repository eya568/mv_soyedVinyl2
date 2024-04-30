<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VinylMixRepository;
class VinylController extends AbstractController
{
   
    #[Route("/",name:'app_homepage')]
    function homePage():Response{
        $tracks = [
            ['song' => 'Kangaroo_MusiQue', 'artist' => 'Kangaro'],
            ['song' => 'Sevish', 'artist' => 'SS'],
            ['song' => 'brring', 'artist' => 'soundeffects'],
            ['song' => 'pazamodules', 'artist' => 'pang'],
            ['song' => 'race', 'artist' => 'riceracer'],
            ['song' => 'win', 'artist' => 'riceracer'],
        ];
       
        return $this->render('vinyl/homepage.html.twig',[
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(VinylMixRepository $mixRepository, string $slug = null): Response{
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $mixRepository->findAllOrderedByVotes();
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
