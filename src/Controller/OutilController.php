<?php

namespace App\Controller;

use App\Entity\Outil;
use App\Form\OutilType;
use App\Repository\OutilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/outil')]
final class OutilController extends AbstractController
{
    #[Route(name: 'app_outil_index', methods: ['GET'])]
    public function index(OutilRepository $outilRepository): Response
    {
        return $this->render('outil/index.html.twig', [
            'outils' => $outilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_outil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $outil = new Outil();
        $form = $this->createForm(OutilType::class, $outil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('image')->getData();
            // var_dump($uploadedFile);
            // die();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/img';
                $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move($destination, $newFilename);
                    $outil->setImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('.', 'Erreur lors du téléchargement du fichier.');
                    
                }
            } else {
                $outil->setImage('default.jpg'); // Éviter l'erreur en base de données
            }
               
            $entityManager->persist($outil);
            $entityManager->flush();
           
         
  
            return $this->redirectToRoute('app_outil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('outil/new.html.twig', [
            'outil' => $outil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_outil_show', methods: ['GET'])]
    public function show(Outil $outil): Response
    {
        return $this->render('outil/show.html.twig', [
            'outil' => $outil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_outil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Outil $outil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OutilType::class, $outil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('image')->getData();
            // var_dump($uploadedFile);
            // die();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/img';
                $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move($destination, $newFilename);
                    $outil->setImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('.', 'Erreur lors du téléchargement du fichier.');
                    
                }
            } else {
                $outil->setImage('default.jpg'); // Éviter l'erreur en base de données
            }
            
            $entityManager->persist($outil);
            $entityManager->flush();
           
         
  
            return $this->redirectToRoute('app_outil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('outil/edit.html.twig', [
            'outil' => $outil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_outil_delete', methods: ['POST'])]
    public function delete(Request $request, Outil $outil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($outil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_outil_index', [], Response::HTTP_SEE_OTHER);
    }
}
