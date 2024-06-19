<?php

namespace App\Controller;

use App\Entity\MorningRoutines;
use App\Form\MorningRoutinesType;
use App\Repository\MorningRoutinesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/morning/routines')]
class MorningRoutinesController extends AbstractController
{
    #[Route('/', name: 'app_morning_routines_index', methods: ['GET'])]
    public function index(MorningRoutinesRepository $morningRoutinesRepository): Response
    {
        return $this->render('morning_routines/index.html.twig', [
            'morning_routines' => $morningRoutinesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_morning_routines_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $morningRoutine = new MorningRoutines();
        $form = $this->createForm(MorningRoutinesType::class, $morningRoutine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($morningRoutine);
            $entityManager->flush();

            return $this->redirectToRoute('app_morning_routines_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('morning_routines/new.html.twig', [
            'morning_routine' => $morningRoutine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_morning_routines_show', methods: ['GET'])]
    public function show(MorningRoutines $morningRoutine): Response
    {
        return $this->render('morning_routines/show.html.twig', [
            'morning_routine' => $morningRoutine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_morning_routines_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MorningRoutines $morningRoutine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MorningRoutinesType::class, $morningRoutine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_morning_routines_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('morning_routines/edit.html.twig', [
            'morning_routine' => $morningRoutine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_morning_routines_delete', methods: ['POST'])]
    public function delete(Request $request, MorningRoutines $morningRoutine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$morningRoutine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($morningRoutine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_morning_routines_index', [], Response::HTTP_SEE_OTHER);
    }
}
