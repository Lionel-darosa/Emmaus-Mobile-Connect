<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use App\Service\PriceCalculator;
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
    #[Route('/comparateur', name: 'index_comparateur', methods: ['GET'])]
    public function indexComparator(DeviceRepository $deviceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $devices = $paginator->paginate(
            $deviceRepository->findAll(),
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('device/indexComparator.html.twig', [
            'devices' => $devices,
        ]);
    }

    #[IsGranted('ROLE_EMPLOYEE')]
    #[Route('/calcul', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeviceRepository $deviceRepository, PriceCalculator $priceCalculator): Response
    {
        $device = new Device();

        //Form sauvegarder
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $price = $priceCalculator->calculate($device);
            $device->setPrice($price);
            $deviceRepository->save($device, true);
            var_dump($price);

            $this->addFlash('success', 'L\'appareil a été bien ajouté au catalogue avec un prix de ' . $price . '€ ! :)');

            return $this->redirectToRoute('device_show', ['id' => $device->getId()], Response::HTTP_SEE_OTHER);
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
        if ($this->isCsrfTokenValid('delete'. $device->getId(), $request->request->get('_token'))) {
            $deviceRepository->remove($device, true);
        }

        $this->addFlash('danger', 'Oh! L\'appareil a été bien supprimé du catalogue! :(');

        return $this->redirectToRoute('device_index', [], Response::HTTP_SEE_OTHER);
    }
}
