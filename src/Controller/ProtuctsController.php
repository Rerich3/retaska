<?php

namespace App\Controller;

use App\Entity\Protucts;
use App\Form\ProtuctsType;
use App\Repository\ProtuctsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/product")
 */
class ProtuctsController extends AbstractController
{
    /**
     * @Route("/", name="protucts_index", methods={"GET"})
     */
    public function index(ProtuctsRepository $protuctsRepository): Response
    {
        return $this->render('protucts/index.html.twig', [
            'protucts' => $protuctsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="protucts_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $protuct = new Protucts();
        $form = $this->createForm(ProtuctsType::class, $protuct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($protuct);
            $entityManager->flush();

            return $this->redirectToRoute('protucts_index');
        }

        return $this->render('protucts/new.html.twig', [
            'protuct' => $protuct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protucts_show", methods={"GET"})
     */
    public function show(Protucts $protuct): Response
    {
        return $this->render('protucts/show.html.twig', [
            'protuct' => $protuct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="protucts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Protucts $protuct): Response
    {
        $form = $this->createForm(ProtuctsType::class, $protuct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('protucts_index');
        }

        return $this->render('protucts/edit.html.twig', [
            'protuct' => $protuct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protucts_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Protucts $protuct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$protuct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($protuct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('protucts_index');
    }
}
