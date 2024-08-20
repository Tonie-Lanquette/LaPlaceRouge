<?php

namespace App\Controller;

use App\Entity\Dishies;
use App\Form\DishiesType;
use App\Repository\DishiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dish')]
class DishiesController extends AbstractController
{
    #[Route('ies', name: 'app_dishies_index', methods: ['GET'])]
    public function index(DishiesRepository $dishiesRepository): Response
    {
        return $this->render('dishies/index.html.twig', [
            'dishies' => $dishiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dishies_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dishy = new Dishies();
        $form = $this->createForm(DishiesType::class, $dishy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dishy);
            $entityManager->flush();

            return $this->redirectToRoute('app_dishies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dishies/new.html.twig', [
            'dishy' => $dishy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dishies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dishies $dishy, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DishiesType::class, $dishy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dishies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dishies/edit.html.twig', [
            'dishy' => $dishy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dishies_delete', methods: ['POST'])]
    public function delete(Request $request, Dishies $dishy, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dishy->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dishy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dishies_index', [], Response::HTTP_SEE_OTHER);
    }
}
