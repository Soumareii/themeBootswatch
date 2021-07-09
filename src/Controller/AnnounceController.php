<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Form\AnnounceType;
use App\Repository\AnnounceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnounceController extends AbstractController
{
    /**
     * @Route("/announces", name="announces_index")
     */
    public function index(AnnounceRepository $repo): Response
    {
        $announces = $repo->findAll();
        return $this->render('announce/index.html.twig', [
            'announces' => $announces,
        ]);
    }

    /**
     * @Route("/announces/new", name="announces_create")
     * @Route("announces/{slug}/edit", name="announces_edit")
     */
    public function form(Announce $announce = null, EntityManagerInterface $em, Request $request ): Response
    {   
        if(!$announce) {
            $announce = new Announce();
        }

        $form = $this->createForm(AnnounceType::class, $announce);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Récupération de l'image du formulaire
            $coverImage = $form->get('coverImage')->getData();
            if($coverImage) {

                // Création d'un nm pour l'image avec l'extension récupérée
                $imageName = md5(uniqid()) . '.' . $coverImage->guessExtension();

                // On déplace l'image dans le répertoire cover_image_direction avec le nom créé
                $coverImage->move(
                    $this->getParameter('cover_image_directory'),
                    $imageName
                );

                // On enregistre le nom de l'image dans la base de données
                $announce->setCoverImage($imageName);

            }

            $em->persist($announce);
            $em->flush();
            
            if('editMode'){
                $this->addFlash('success', 'Une annonce a été supprimée !');
            }
            else {
                $this->addFlash('success', 'Une nouvelle annonce a été créée !');
            }
            

            return $this->redirectToRoute('announces_index');
        }

        return $this->render('announce/create.html.twig', [
            'form' => $form->createView(),
            'editMode' => $announce->getId() !== null,
        ]);

    }

    /**
     * @Route("/announces/{slug}", name="announces_show")
     */
    public function show(Announce $announce): Response
    {
        

        return $this->render('announce/show.html.twig', [
            'announce' => $announce,
        ]);
    }

    /**
     *
     * @Route("/announces/{slug}/delete", name="announces_delete")
     */
    public function delete(Announce $announce, EntityManagerInterface $em) {
        
        $em->remove($announce);
        $em->flush();

        $this->addFlash('success', "l'annonce a été supprimée!");
        return $this->redirectToRoute('announces_index');
        
    }


} 
