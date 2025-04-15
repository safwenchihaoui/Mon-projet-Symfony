<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Categories;
use App\Entity\Evennement;
use App\Entity\Hopital;
use App\Entity\Recommandation;
use App\Entity\Slider;
use App\Entity\Sousmission;
use App\Form\EvennementType;
use App\Form\SousmissionType;
use App\Repository\AuteurRepository;
use App\Repository\CategorieOutilRepository;
use App\Repository\CategorieRecommandRepository;
use App\Repository\CategorieRepository;
use App\Repository\CategoriesRepository;
use App\Repository\DocteurRepository;
use App\Repository\EvennementRepository;
use App\Repository\EventRepository;
use App\Repository\HopitalRepository;
use App\Repository\OutilRepository;
use App\Repository\RecommandationRepository;
use App\Repository\SliderRepository;
use App\Repository\SouscategorieOutilRepository;
use App\Repository\SouscategorieRecommandRepository;
use App\Repository\SousmissionRepository;
use DirectoryIterator;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Error;
use PhpCsFixer\Fixer\FunctionNotation\NullableTypeDeclarationForDefaultNullValueFixer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

final class LayoutController extends AbstractController
{
    #[Route('/',name:'app_homepage')]
    
    public function index( SousmissionRepository $sousmissionRepository,EvennementRepository $evennementRepository,CategorieOutilRepository $categorieOutilRepository, HopitalRepository $hopitalRepository    ,SliderRepository $sliderRepository,CategorieRecommandRepository $categorieRecommandRepository  ): Response
    {
         $sousmission=$sousmissionRepository->findAll();
        $evennements=$evennementRepository->findAll();

      $categorieOutils=$categorieOutilRepository->findAll();
    
        $hopitale=$hopitalRepository->findAll();

         $Hopitaux=$hopitalRepository->findAll(); 
     
        $CategorieRecommands=$categorieRecommandRepository->findAll();

         $sliders = $sliderRepository->findBy(['etat'=>'1'],['id'=>'DESC']);
             

     return $this->render('front/index.html.twig', [
           'sliders' => $sliders , 
           'CategorieRecommands'=>$CategorieRecommands,
            'hopitaux'=>$Hopitaux,
           'hopitale'=>$hopitale,
           'CategorieOutils'=>$categorieOutils,
           'evennement'=>$evennements,
           'Sousmission'=>$sousmission,
           
        ]);
    }

    #[Route('/{id}/CategorieRecommand',name:'app_CategorieRecommand')]
    public function categorieRecommand( HopitalRepository $hopitalRepository ,$id ,RecommandationRepository $RecommandationRepository, CategorieRecommandRepository $categorieRecommandRepository,SouscategorieRecommandRepository $souscategorieRecommandRepository)
    {
        //categorie 
     
        $CategorieRecommands=$categorieRecommandRepository->findAll();
        $CategorieRecommand=$categorieRecommandRepository->findOneBy(['id'=>$id]);
        $SouscategorieRecommands=$souscategorieRecommandRepository->findBy(['CategorieRecommand' => $CategorieRecommand->getId()]);
       
    // recomandation 

      $Recommandation =$RecommandationRepository->findAll();

      $Hopitaux=$hopitalRepository->findAll(); 

        return $this->render('front/CategorieRecommand.html.twig', [
        'CategorieRecommands'=>$CategorieRecommands,
        'SouscategorieRecommands'=> $SouscategorieRecommands,
        'CategorieRecommand'=>$CategorieRecommand,
        'recommandation'=>$Recommandation,
        'hopitaux'=>$Hopitaux,
           
        ]);

    }

     #[Route('/{id}/Hopital',name:'app_Hopital')]
     public function hopital($id, DocteurRepository $docteursRepository,CategorieRecommandRepository $categorieRecommandRepository,HopitalRepository $hopitalRepository)
    {
         $CategorieRecommands=$categorieRecommandRepository->findAll();

          // hopital
          
             $Hopitaux=$hopitalRepository->findAll();
            $Hopital=$hopitalRepository->findOneBy(['id'=>$id]); 
           $Docteur=$docteursRepository->findBy(['Hopital' => $Hopital]);
    // //    dump($Hopital);
    // //    die();
         
    //       //docteus
      
         $Docteurs=$docteursRepository->findAll();
        
         return $this->render('front/Hopital.html.twig', [
              'CategorieRecommands'=>$CategorieRecommands,
              'hopitaux'=>$Hopitaux,
              'docteurs'=>$Docteurs,
              'hopital' => $Hopital,
             
             
        ]);
          
     }

    #[Route('/docteur',name:'app_docteur')]
    public function docteur( DocteurRepository $docteursRepository,HopitalRepository   $hopitalRepository )
    {
        $Hopitaux=$hopitalRepository->findAll();
    
        return $this->render('front/docteur.html.twig', [
            'hopitaux'=>$Hopitaux,
            
        ]);     
    }
      #[Route('/hopitale',name:'app_hopitale')]
    public function hopitale(   DocteurRepository $docteursRepository ,CategorieRecommandRepository $categorieRecommandRepository,HopitalRepository   $hopitalRepository )
    {
        $Docteurs=$docteursRepository->findAll();
        $CategorieRecommands=$categorieRecommandRepository->findAll();

        //// hopital //////
           
        $Hopitaux=$hopitalRepository->findAll();
       
        return $this->render('front/hopitale.html.twig', [
           'CategorieRecommands'=>$CategorieRecommands,
            'hopitaux'=>$Hopitaux,
            'docteurs'=>$Docteurs,
        //    'Hopital' => $Hopital,
        ]);
          
    }

    #[Route('/CategorieOutil', name:'app_CategorieOutil')]
    public function CategorieOutil(OutilRepository $outilRepository,SouscategorieOutilRepository $souscategorieOutilRepository, CategorieOutilRepository $categorieOutilRepository, CategorieRecommandRepository $categorieRecommandRepository)
    {
        $CategorieRecommands=$categorieRecommandRepository->findAll();

             $categorieOutils =$categorieOutilRepository->findAll();
           
            // $CategorieOutil = $categorieOutilRepository->findOneBy(['id' => $id]);
            //    var_dump($categorieOutils);
            //      die();
            $SouscategorieOutils = $souscategorieOutilRepository->findAll();
            
        ///// outils//////
            $outil=$outilRepository->findAll();

        return $this->render('front/CategorieOutil.html.twig', [
            'CategorieOutils' => $categorieOutils,
            'CategorieRecommands' => $CategorieRecommands,
            'SouscategorieOutils' => $SouscategorieOutils,
            'Outils'=>$outil,
        ]);
    }
    


    #[Route('/soumission', name: 'app_soumission_new',methods:['POST','GET'])]
    public function new(
        Request $request,
        CategorieRecommandRepository $categorieRecommandRepository,
        EntityManagerInterface $entityManager,
        SousmissionRepository $sousmissionRepository,
        EvennementRepository $evennementRepository,
        SluggerInterface $slugger,
        AuteurRepository $auteurRepository,
         int $id=1
    ): Response {
        
        
        $categorieRecommands = $categorieRecommandRepository->findAll();
        
        $evennement=$evennementRepository->findOneBy(['id'=>$id]);
       
        $sousmission = new Sousmission();
        $form = $this->createForm(SousmissionType::class, $sousmission);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            
            $sousmission->setEvennement($evennement);
    
            
            foreach ($sousmission->getAuteurs() as $auteur) {
                $auteur->setSousmission($sousmission);
            }
            
           
            $fichier = $form->get('fichier')->getData();
            if ($fichier) {
                $originalFilename = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$fichier->guessExtension();
    
                try {
                    $fichier->move(
                        $this->getParameter('fichierSoumission_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    
                }
                $sousmission->setFichier($newFilename);
            }
            $sousmission->setDate(new \DateTime());
            
            var_dump($sousmission->getDate());
            die();
            $entityManager->persist($sousmission);
            $entityManager->flush();
    
           
    
            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('front/new_mission.html.twig', [
            'CategorieRecommands' => $categorieRecommands,
            'sousmission'         => $sousmission,  
            'form'                => $form->createView(),
            'id'=>$id
        ]);
    }
    
    #[Route('/{id}/soumission/edit', name: 'app_soumission_edit')]

    public function edit( $id,
        Request $request,
        CategorieRecommandRepository $categorieRecommandRepository,
        EntityManagerInterface $entityManager,
        SousmissionRepository $sousmissionRepository,
        EvennementRepository $evennementRepository,
        SluggerInterface $slugger,
        Sousmission $sousmission

    ): Response {
        
        $categorieRecommands = $categorieRecommandRepository->findAll();
         $evennement=$evennementRepository->findOneBy(['id'=>$id]);  
        
       
        $form = $this->createForm(SousmissionType::class, $sousmission);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $sousmission->setEvennement( $evennement);

            $fichier = $form->get('fichier')->getData();
            if ($fichier ) {
                $originalFilename = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
             
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$fichier->guessExtension();
                
                try {
                    $fichier->move(
                        $this->getParameter('fichierSoumission_directory'),
                        $newFilename
                    );
                   
                } catch (FileException $e) {
               
                }
                $sousmission->setfichier(fichier: $newFilename);
            }   
           
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'mission is update! Yes!'
            );

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('front/mission/edit_mission.html.twig', [
            'CategorieRecommands' => $categorieRecommands,
            'formmission' => $form->createView(),

            
        ]);
    }
    
    


   
    #[Route('/recommandation',name:'app_Recommandation')]
    public function recommandation( HopitalRepository $hopitalRepository)
    {
        
        $Hopitaux=$hopitalRepository->findAll(); 
        return $this->render('front/recommandation.html.twig', [
            'hopitaux'=>$Hopitaux,
        ]);
          
    }

   
   
    #[Route('/login',name:'app_login')]
    public function login()
    {
        

        return $this->render('front/login.html.twig', []);
          
    }
    public function mon_espace()
    {
        

        return $this->render('mon_compte/index.html.twig', []);
          
    }
    
   
}
      
    
    