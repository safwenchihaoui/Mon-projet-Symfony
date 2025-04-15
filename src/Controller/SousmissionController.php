<?php

namespace App\Controller;

use App\Entity\Sousmission;
use App\Form\SousmissionType;
use App\Repository\SousmissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/sousmission')]
final class SousmissionController extends AbstractController
{
    #[Route(name: 'app_sousmission_index', methods: ['GET'])]
    public function index(SousmissionRepository $sousmissionRepository): Response
    {
        return $this->render('sousmission/index.html.twig', [
            'sousmissions' => $sousmissionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sousmission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $sousmission = new Sousmission();
        $form = $this->createForm(SousmissionType::class, $sousmission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
            $entityManager->persist($sousmission);
            $entityManager->flush();

            return $this->redirectToRoute('app_sousmission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sousmission/new.html.twig', [
            'sousmission' => $sousmission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sousmission_show', methods: ['GET'])]
    public function show(Sousmission $sousmission): Response
    {
        return $this->render('sousmission/show.html.twig', [
            'sousmission' => $sousmission,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sousmission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sousmission $sousmission, EntityManagerInterface $entityManager,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(SousmissionType::class, $sousmission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

            return $this->redirectToRoute('app_sousmission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sousmission/edit.html.twig', [
            'sousmission' => $sousmission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sousmission_delete', methods: ['POST'])]
    public function delete(Request $request, Sousmission $sousmission, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousmission->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sousmission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sousmission_index', [], Response::HTTP_SEE_OTHER);
    }
}
