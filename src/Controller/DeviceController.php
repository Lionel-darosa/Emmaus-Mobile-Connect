<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Form\SellAssistantType;
use App\Form\StockType;
use App\Repository\DeviceRepository;
use App\Service\PriceCalculator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/smartphone', name:'device_')]
class DeviceController extends AbstractController
{
    #[IsGranted('ROLE_EMPLOYEE')]
    #[Route('/stock', name: 'index_stock', methods: ['GET', 'POST'])]
    public function index(DeviceRepository $deviceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        
        $form = $this->createForm(StockType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resultFilters =  $form->getData();
            $devices = $deviceRepository->filterDevices($resultFilters);
        } else {
            $devices = $paginator->paginate(
                $deviceRepository->findAll(),
                $request->query->getInt('page', 1),
                20
            );
        }

        return $this->render('device/indexStock.html.twig', [
            'devices' => $devices,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_EMPLOYEE')]
    #[Route('/comparateur', name: 'index_comparateur', methods: ['GET', 'POST'])]
    public function indexComparator(DeviceRepository $deviceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $form = $this->createForm(SellAssistantType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sort = $form->getData();
            $devices = $paginator->paginate(
                $deviceRepository->sortDevices($sort),
                $request->query->getInt('page', 1),
                20
            );
        } else {
            $devices = $paginator->paginate(
                $deviceRepository->findAll(),
                $request->query->getInt('page', 1),
                20
            );
        }

        return $this->render('device/indexComparator.html.twig', [
            'devices' => $devices,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_EMPLOYEE')]
    #[Route('/calcul', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeviceRepository $deviceRepository, PriceCalculator $priceCalculator): Response
    {
        $device = new Device();

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

    #[Route('/voir/{id}', name: 'show', methods: ['GET'])]
    public function show(Device $device): Response
    {
        return $this->render('device/show.html.twig', [
            'device' => $device,
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET','POST'])]
    public function edit(Request $request, Device $device, DeviceRepository $deviceRepository, PriceCalculator $priceCalculator): Response
    {
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $price = $priceCalculator->calculate($device);
            $device->setPrice($price);
            $deviceRepository->save($device, true);

            $this->addFlash('success', 'Le smartphone a été bien modifié ! :)');

            return $this->redirectToRoute('device_index_stock');
        }

        return $this->render('device/edit.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Device $device, DeviceRepository $deviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'. $device->getId(), $request->request->get('_token'))) {
            $deviceRepository->remove($device, true);
            $this->addFlash('danger', 'Le smartphone a été bien supprimé du stock');
        }
        return $this->redirectToRoute('device_index_stock');
    }
}
