<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class MovieController extends AbstractController
{


    #[Route('/addmovie', name: 'app_addmovie')]
    public function addmovie(Request $request, EntityManagerInterface $em): Response
{
    $movie = new Movie();
    $form = $this->createForm(MovieType::class, $movie);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Persistez le film
        $em->persist($movie);

        // Persistez les horaires associés au film
        foreach ($movie->getHoraires() as $horaire) {
            $em->persist($horaire);
        }

        $em->flush();

        $this->addFlash('success', 'Le film a bien été créé');
        return $this->redirectToRoute('app_home');
    } 

    return $this->render('movie/addmovie.html.twig', [
        'form' => $form->createView()
    ]);
}

}
