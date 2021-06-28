<?php

namespace App\Controller;

use App\Repository\AnnounceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnounceController extends AbstractController
{
    /**
     * @Route("/announce", name="announce")
     */
    public function index(AnnounceRepository $repo): Response
    {
        $announces = $repo->findAll();
        return $this->render('announce/index.html.twig', [
            'announces' => $announces,
        ]);
    }

    /**
     * @Route("/announce/{id}", name="announce_show")
     */
    public function show(AnnounceRepository $repo, int $id): Response
    {
        $announce = $repo->find($id);
        return $this->render('announce/show.html.twig', [
            'announce' => $announce,
        ]);
    }
}
