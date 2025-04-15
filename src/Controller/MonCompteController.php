<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MonCompteController extends AbstractController
{
    #[Route('/mon/compte', name: 'app_mon_compte')]
   
    public function index(Security $security): Response
    {
      
        $user = $this->getUser();
      
        

        if (in_array('ROLE_AUTEUR', $user->getRoles()))
       {  
       return $this->render('mon_compte/index.html.twig');
       }
     else{

     return $this->render('admin/index.html.twig'); 
      }       

   }
    
}
