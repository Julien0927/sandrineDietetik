<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyPolicyController extends AbstractController
{
    #[Route('/privacy/policy', name: 'app_privacy')]
    public function index(): Response
    {
        return $this->render('privacy/index.html.twig', [
            'controller_name' => 'PrivacyPolicyController',
        ]);
    }
}
