<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\Device;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchByBrand', SearchType::class, [
                'attr' => [
                    'placeholder' => 'Rechercher par marque',
                    'class' => 'form-control'
                ],
                'label' => false,               
                'required' => false,       
                ])  

            ->add('model', ChoiceType::class, [
                'placeholder' => 'Modèle',
                'attr' => ['class'=>'form-select'],
                'label' => false,
                'choices' => Device::PHONE,
                'required' => false,        
                ]) 
        
            ->add('price', ChoiceType::class, [
                'placeholder' => 'Prix maximum',
                'attr' => ['class'=>'form-select'],
                'choices' => Device::PRICE,
                'required' => false,
                'label' => false,
                ])

            ->add('agency', EntityType::class, [
                'placeholder' => 'Lieux de vente',
                'attr' => ['class'=>'form-select'],
                'class' => Agency::class,
                'choice_label' => 'city',
                'required' => false,  
                'label'=> false,         
                ])   

            ->add('soldAt', CheckboxType::class, [
                'label' => 'En Stock',
                'attr' => [
                    'class'=>'form-check-input',
                    'class-label'=> 'form-check-label',
                ],
                'required' => false,
                ])

            ->add('state', ChoiceType::class, [
                'placeholder' => 'Etat',
                'attr' => ['class'=>'form-select'],
                'label' => false,
                'choices' => Device::STATE,
                'required' => false,
                ])
            ; 
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
