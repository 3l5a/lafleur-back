<?php

namespace App\Controller;

use App\Entity\Measurement;
use App\Form\MeasurementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
#[Route('/measurement')]
class MeasurementController extends AbstractController
{
    #[Route('/', name: 'app_measurement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $measurements = $entityManager
            ->getRepository(Measurement::class)
            ->findAll();

        return $this->render('measurement/index.html.twig', [
            'measurements' => $measurements,
        ]);
    }

    #[Route('/new', name: 'app_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $measurement = new Measurement();
        $form = $this->createForm(MeasurementType::class, $measurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($measurement);
            $entityManager->flush();

            return $this->redirectToRoute('app_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurement/new.html.twig', [
            'measurement' => $measurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurement_show', methods: ['GET'])]
    public function show(Measurement $measurement): Response
    {
        return $this->render('measurement/show.html.twig', [
            'measurement' => $measurement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Measurement $measurement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MeasurementType::class, $measurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurement/edit.html.twig', [
            'measurement' => $measurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurement_delete', methods: ['POST'])]
    public function delete(Request $request, Measurement $measurement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$measurement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($measurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_measurement_index', [], Response::HTTP_SEE_OTHER);
    }
}
