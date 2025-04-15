<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Security $security  ): Response
{
    $user = $security->getUser();

    

    if (!$user || !in_array('ROLE_AUTEUR', $user->getRoles())) {
        throw $this->createAccessDeniedException("Accès refusé");
    }

    return $this->render('profil/index.html.twig', [
        'user' => $user,
    ]);
}
  

     
      
           
      
   
  
         
           
    
}
