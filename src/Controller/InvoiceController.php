<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        
        $p= new Invoice();
        $form = $this->createForm(InvoiceType::class, $p, array('action'=>$this->generateUrl('add_invoice')));
        $data['form'] = $form->createView();
        $data['invoices'] = $em->getRepository(Invoice::class)->findAll();
        return $this->render('invoice/list.html.twig',$data);
    }

    
    #[Route('/invoice/add', name: 'add_invoice')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class,$invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($invoice);
            $em->flush();
        }
        return$this->redirectToRoute('index');
    }
}
