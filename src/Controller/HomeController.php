<?php

namespace App\Controller;

use App\Repository\AnnounceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
        public function index(AnnounceRepository $repo): Response
        {
            $announces = $repo->findAll();
            return $this->render('home/index.html.twig', [
                'announces' => $announces,
            ]);
        }

   /* public function index(): Response
    {
        return $this->render('location/index.html.twig', [
            'controller_name' => 'LocationController',
        ]);
    } */
}
