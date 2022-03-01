<?php

namespace App\Form;

use App\Entity\InvoiceLine;
use App\Entity\Invoice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('invoiceid',EntityType::class, array('class'=>Invoice::class,'label'=>'Invoice','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('description',TextType::class, array('label'=>'Description','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('quantity',TextType::class, array('label'=>'Quantityr','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('amount',TextType::class, array('label'=>'Amount','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('vat',TextType::class, array('label'=>'VAT','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('totalvat',TextType::class, array('label'=>'Total VAT','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('Validate', SubmitType::class, array('attr'=>array('class'=>'btn btn-success form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoiceLine::class,
        ]);
    }
}
