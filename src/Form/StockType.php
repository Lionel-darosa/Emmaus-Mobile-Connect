<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\Device;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                // 'placeholder' => 'Rechercher une marque', 
                'label' => false,               
                'required' => false,            
                ])   
        
            ->add('price', ChoiceType::class, [
                'choices'  => [
                    '20€' => '20',
                    '30€' => '30',
                    '40€' => '40',
                    '50€' => '50',
                    '60€' => '60',
                    '70€' => '70',
                    '80€' => '80',
                ],
                'required' => false,
                'label' => 'Prix',
                'expanded' => true,
                'multiple' => true,
                ])

            ->add('agency', EntityType::class, [
                'placeholder' => 'Lieux de vente',
                'class' => Agency::class,
                'choice_label' => 'city',
                'required' => false,  
                'label'=> false,         
                ])   

            ->add('soldAt', ChoiceType::class, [
                'placeholder' => 'Disponibilité',
                'choices'  => [
                    'Oui' => true,
                    'Non' => null,
                ],
                'required' => false,
                'label' => false,
                ])

            ->add('state', ChoiceType::class, [
                'placeholder' => 'Etat',
                'label' => false,
                'choices' => Device::STATE,
                'required' => false,
                ])
            ; 
        }

    // magasin => select
    // dispo => select
    // prix  => checkbox
    // statut => checkbox
    // bar de recherche pour chercher marque et modèle 

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
