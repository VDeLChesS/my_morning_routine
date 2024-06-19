<?php

namespace App\Controller;

use App\Entity\Challenges;
use App\Form\ChallengesType;
use App\Repository\ChallengesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/challenges')]
class ChallengesController extends AbstractController
{
    #[Route('/', name: 'app_challenges_index', methods: ['GET'])]
    public function index(ChallengesRepository $challengesRepository): Response
    {
        return $this->render('challenges/index.html.twig', [
            'challenges' => $challengesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_challenges_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $challenge = new Challenges();
        $form = $this->createForm(ChallengesType::class, $challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($challenge);
            $entityManager->flush();

            return $this->redirectToRoute('app_challenges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('challenges/new.html.twig', [
            'challenge' => $challenge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_challenges_show', methods: ['GET'])]
    public function show(Challenges $challenge): Response
    {
        return $this->render('challenges/show.html.twig', [
            'challenge' => $challenge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_challenges_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Challenges $challenge, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChallengesType::class, $challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_challenges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('challenges/edit.html.twig', [
            'challenge' => $challenge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_challenges_delete', methods: ['POST'])]
    public function delete(Request $request, Challenges $challenge, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$challenge->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($challenge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_challenges_index', [], Response::HTTP_SEE_OTHER);
    }
}
