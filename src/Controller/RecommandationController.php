<?php

namespace App\Controller;

use App\Entity\Recommandation;
use App\Entity\SouscategorieRecommand;
use App\Form\RecommandationType;
use App\Repository\RecommandationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/recommandation')]
final class RecommandationController extends AbstractController
{
    #[Route(name: 'app_recommandation_index', methods: ['GET'])]
    public function index(RecommandationRepository $recommandationRepository  ): Response
    {
        
        return $this->render('recommandation/index.html.twig', [
            'recommandations' => $recommandationRepository->findAll(),
            
        ]);
    }

    #[Route('/new', name: 'app_recommandation_new', methods: ['GET', 'POST'])]
    public function new(Request $request,   SluggerInterface  $slugger, EntityManagerInterface $entityManager): Response
    {
        
        $recommandation = new Recommandation();
        $form = $this->createForm(RecommandationType::class, $recommandation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
             $pdf = $form->get('fichier')->getData();

            if ($image ) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                   
                } catch (FileException $e) {
                    
                }

                
                $recommandation->setImage(image: $newFilename);
               
              
            }
            
            if ($pdf ) {
                $originalFilename = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
             
               
                
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdf->guessExtension();
                
             

                try {
                    $pdf->move(
                        $this->getParameter('pdf_directory'),
                        $newFilename
                    );
                   
                } catch (FileException $e) {
                    
                }

                
                $recommandation->setPdf(pdf: $newFilename);
               
              
            }


         
            $entityManager->persist($recommandation);
            $entityManager->flush();

          
       
            return $this->redirectToRoute('app_recommandation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recommandation/new.html.twig', [
            
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recommandation_show', methods: ['GET'])]
    public function show(Recommandation $recommandation): Response
    {

        

        return $this->render('recommandation/show.html.twig', [
            'recommandation' => $recommandation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recommandation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recommandation $recommandation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecommandationType::class, $recommandation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();

            return $this->redirectToRoute('app_recommandation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recommandation/edit.html.twig', [
            'recommandation' => $recommandation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recommandation_delete', methods: ['POST'])]
    public function delete(Request $request, Recommandation $recommandation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recommandation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($recommandation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recommandation_index', [], Response::HTTP_SEE_OTHER);
    }
}
