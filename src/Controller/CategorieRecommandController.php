<?php

namespace App\Controller;

use App\Entity\CategorieRecommand;
use App\Form\CategorieRecommandType;
use App\Repository\CategorieRecommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/categorie/recommand')]
final class CategorieRecommandController extends AbstractController
{
    #[Route(name: 'app_categorie_recommand_index', methods: ['GET'])]
    public function index(CategorieRecommandRepository $categorieRecommandRepository): Response
    {
        return $this->render('categorie_recommand/index.html.twig', [
            'categorie_recommands' => $categorieRecommandRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_recommand_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieRecommand = new CategorieRecommand();
        $form = $this->createForm(CategorieRecommandType::class, $categorieRecommand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieRecommand);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_recommand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_recommand/new.html.twig', [
            'categorie_recommand' => $categorieRecommand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_recommand_show', methods: ['GET'])]
    public function show(CategorieRecommand $categorieRecommand): Response
    {

        
        return $this->render('categorie_recommand/show.html.twig', [
            'categorie_recommand' => $categorieRecommand,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_recommand_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieRecommand $categorieRecommand, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieRecommandType::class, $categorieRecommand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_recommand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_recommand/edit.html.twig', [
            'categorie_recommand' => $categorieRecommand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_recommand_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieRecommand $categorieRecommand, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieRecommand->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($categorieRecommand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_recommand_index', [], Response::HTTP_SEE_OTHER);
    }
}
