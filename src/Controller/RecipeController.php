<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipe', name: 'app_recipe')]
    public function index(RecipeRepository $recipeRepository, Security $security): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Si l'utilisateur est administrateur, récupérer toutes les recettes
        if ($security->isGranted('ROLE_ADMIN')) {
            $recipes = $recipeRepository->findBy([], ['id' => 'DESC']);
        } elseif ($user) {
            // Si l'utilisateur est connecté

            // Si l'utilisateur a un régime défini, récupérer les recettes en fonction du régime
            if ($user->getDietType()->count() > 0) {
                $recipes = $recipeRepository->findByDietType($user->getDietType(), ['id' => 'DESC']);
            } else {
                // Si l'utilisateur n'a pas de régime défini, récupérer toutes les recettes
                $recipes = $recipeRepository->findBy([], ['id' => 'DESC']);
            }
        } else {
            // Si l'utilisateur est un visiteur, récupérer les recettes accessibles uniquement
            $recipes = $recipeRepository->findBy(['isAccessible' => true], ['id' => 'DESC']);
        
        }
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
