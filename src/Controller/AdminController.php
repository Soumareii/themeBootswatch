<?php

namespace App\Controller;

use App\Repository\AnnounceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(AnnounceRepository $repo): Response
    {
        $announces = $repo->findAll();
        return $this->render('admin/index.html.twig', [
            'announces' => $announces,
        ]);
    }


}
