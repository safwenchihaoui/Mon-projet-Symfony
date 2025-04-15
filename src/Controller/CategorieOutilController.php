<?php

namespace App\Controller;

use App\Entity\CategorieOutil;
use App\Form\CategorieOutilType;
use App\Repository\CategorieOutilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/categorie/outil')]
final class CategorieOutilController extends AbstractController
{
    #[Route(name: 'app_categorie_outil_index', methods: ['GET'])]
    public function index(CategorieOutilRepository $categorieOutilRepository): Response
    {
        return $this->render('categorie_outil/index.html.twig', [
            'categorie_outils' => $categorieOutilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_outil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieOutil = new CategorieOutil();
        $form = $this->createForm(CategorieOutilType::class, $categorieOutil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieOutil);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_outil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_outil/new.html.twig', [
            'categorie_outil' => $categorieOutil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_outil_show', methods: ['GET'])]
    public function show(CategorieOutil $categorieOutil): Response
    {
        return $this->render('categorie_outil/show.html.twig', [
            'categorie_outil' => $categorieOutil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_outil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieOutil $categorieOutil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieOutilType::class, $categorieOutil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_outil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_outil/edit.html.twig', [
            'categorie_outil' => $categorieOutil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_outil_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieOutil $categorieOutil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieOutil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($categorieOutil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_outil_index', [], Response::HTTP_SEE_OTHER);
    }
}
