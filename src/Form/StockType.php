<?php

namespace App\Form;

use App\Entity\Device;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchDevice', SearchType::class)
        
            ->add('price', ChoiceType::class, [
                'choices'  => [
                    '20€-30€' => '20-30',
                    '30€-40€' => '30-40',
                    '40€-50€' => '40-50',
                    '50€-60€' => '50-60',
                    '60€-70€' => '70-80',
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
                ])   

            ->add('soldAt', ChoiceType::class, [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'required' => false,
                'label' => 'Disponibilité',
                ])

            ->add('state', ChoiceType::class, [
                'placeholder' => 'Etat',
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
