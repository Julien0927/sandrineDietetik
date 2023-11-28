<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FullRecipeController extends AbstractController
{

    #[Route('/fullrecipe/{id}', name: 'app_fullrecipe')]
    public function index(EntityManagerInterface $entityManager, $id): Response
    {
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
       
        if(!$recipe) {
            throw $this->createNotFoundException(
                'Recette non trouvée'
            );
        }
        return $this->render('fullrecipe/index.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
