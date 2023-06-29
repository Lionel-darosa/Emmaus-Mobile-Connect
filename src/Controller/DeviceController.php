<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/device', name:'device_')]
class DeviceController extends AbstractController
{
    #[IsGranted('ROLE_EMPLOYEE')]
    #[Route('/stock', name: 'index_stock', methods: ['GET'])]
    public function index(DeviceRepository $deviceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $devices = $paginator->paginate(
            $deviceRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('device/indexStock.html.twig', [
            'devices' => $devices,
        ]);
    }

    #[IsGranted('ROLE_EMPLOYEE')]
    #[Route('/calcul', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeviceRepository $deviceRepository): Response
    {
        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deviceRepository->save($device, true);

            $this->addFlash('success', 'L\'appareil a été bien ajouté au catalogue! :)');

            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('device/new.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Device $device): Response
    {
        return $this->render('device/show.html.twig', [
            'device' => $device,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Device $device, DeviceRepository $deviceRepository): Response
    {
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deviceRepository->save($device, true);

            return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('device/edit.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Device $device, DeviceRepository $deviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->request->get('_token'))) {
            $deviceRepository->remove($device, true);
        }

        $this->addFlash('danger', 'Oh! L\'appareil a été bien supprimé du catalogue! :(');

        return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
    }
}
