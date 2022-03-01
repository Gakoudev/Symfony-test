<?php

namespace App\Controller;

use App\Entity\InvoiceLine;
use App\Entity\Invoice;
use App\Form\InvoiceLineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class InvoiceLineController extends AbstractController
{
    #[Route('/invoice/line', name: 'invoice_line')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        
        $il= new InvoiceLine();
        $form = $this->createForm(InvoiceLineType::class, $il, array('action'=>$this->generateUrl('add_invoiceline')));
        $data['form'] = $form->createView();
        $data['invoicel'] = $em->getRepository(InvoiceLine::class)->findAll();
        return $this->render('invoice_line/list.html.twig',$data);
    }
    
    #[Route('/invoiceline/add', name: 'add_invoiceline')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
        $invoicel = new InvoiceLine();
        //$invoice = new Invoice();
        $form = $this->createForm(InvoiceLineType::class,$invoicel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $invoicel = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($invoicel);
            $em->flush();
        }
        return $this->redirectToRoute('invoice_line');
    }
}
