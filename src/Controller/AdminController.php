<?php

namespace App\Controller;

use App\Entity\Docteur;
use App\Entity\Slider;
use App\Repository\DocteurRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    #[IsGranted("ROLE_USER")]
    
        public function index( Security $security): Response
        {
            $user = $security->getUser();
            if (!$user) {
                return $this->redirectToRoute('app_login'); 
            }
           
           

          MenuItem::linkToCrud('Slides', 'fas fa-images', Slider::class);
            $this->denyAccessUnlessGranted('ROLE_USER');
            
    return $this->render('admin/index.html.twig');
    }
    

    /**
 * @Route("/utilisateurs", name="utilisateurs")
 */
// public function usersList(UserRepository $users)
// {
    // return $this->render('admin/user.html.twig', [
        // 'users' => $users->findAll(),
    // ]);
// }

}//
