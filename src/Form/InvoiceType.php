<?php

namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('invoice_date',DateType::class, array('label'=>"Invoice date",'attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('invoice_number',TextType::class, array('label'=>'Invoice number','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('customer_id',TextType::class, array('label'=>'Customer id','attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('Validate', SubmitType::class, array('attr'=>array('class'=>'btn btn-success form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
