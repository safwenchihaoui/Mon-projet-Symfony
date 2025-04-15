<?php

namespace App\Controller;

use App\Entity\SouscategorieRecommand;
use App\Form\SouscategorieRecommandType;
use App\Repository\SouscategorieRecommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/souscategorie/recommand')]
final class SouscategorieRecommandController extends AbstractController
{
    #[Route(name: 'app_souscategorie_recommand_index', methods: ['GET'])]
    public function index(SouscategorieRecommandRepository $souscategorieRecommandRepository): Response
    {
        return $this->render('souscategorie_recommand/index.html.twig', [
            'souscategorie_recommands' => $souscategorieRecommandRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_souscategorie_recommand_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $souscategorieRecommand = new SouscategorieRecommand();
        $form = $this->createForm(SouscategorieRecommandType::class, $souscategorieRecommand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($souscategorieRecommand);
            $entityManager->flush();

            return $this->redirectToRoute('app_souscategorie_recommand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souscategorie_recommand/new.html.twig', [
            'souscategorie_recommand' => $souscategorieRecommand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_souscategorie_recommand_show', methods: ['GET'])]
    public function show(SouscategorieRecommand $souscategorieRecommand): Response
    {  
        return $this->render('souscategorie_recommand/show.html.twig', [
            'souscategorie_recommand' => $souscategorieRecommand,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_souscategorie_recommand_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SouscategorieRecommand $souscategorieRecommand, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SouscategorieRecommandType::class, $souscategorieRecommand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_souscategorie_recommand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souscategorie_recommand/edit.html.twig', [
            'souscategorie_recommand' => $souscategorieRecommand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_souscategorie_recommand_delete', methods: ['POST'])]
    public function delete(Request $request, SouscategorieRecommand $souscategorieRecommand, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$souscategorieRecommand->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($souscategorieRecommand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_souscategorie_recommand_index', [], Response::HTTP_SEE_OTHER);
    }
}
