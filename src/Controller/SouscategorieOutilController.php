<?php

namespace App\Controller;

use App\Entity\SouscategorieOutil;
use App\Form\SouscategorieOutilType;
use App\Repository\SouscategorieOutilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/souscategorie/outil')]
final class SouscategorieOutilController extends AbstractController
{
    #[Route(name: 'app_souscategorie_outil_index', methods: ['GET'])]
    public function index(SouscategorieOutilRepository $souscategorieOutilRepository): Response
    {
        return $this->render('souscategorie_outil/index.html.twig', [
            'souscategorie_outils' => $souscategorieOutilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_souscategorie_outil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $souscategorieOutil = new SouscategorieOutil();
        $form = $this->createForm(SouscategorieOutilType::class, $souscategorieOutil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($souscategorieOutil);
            $entityManager->flush();

            return $this->redirectToRoute('app_souscategorie_outil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souscategorie_outil/new.html.twig', [
            'souscategorie_outil' => $souscategorieOutil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_souscategorie_outil_show', methods: ['GET'])]
    public function show(SouscategorieOutil $souscategorieOutil): Response
    {
        return $this->render('souscategorie_outil/show.html.twig', [
            'souscategorie_outil' => $souscategorieOutil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_souscategorie_outil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SouscategorieOutil $souscategorieOutil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SouscategorieOutilType::class, $souscategorieOutil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_souscategorie_outil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souscategorie_outil/edit.html.twig', [
            'souscategorie_outil' => $souscategorieOutil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_souscategorie_outil_delete', methods: ['POST'])]
    public function delete(Request $request, SouscategorieOutil $souscategorieOutil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$souscategorieOutil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($souscategorieOutil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_souscategorie_outil_index', [], Response::HTTP_SEE_OTHER);
    }
}
