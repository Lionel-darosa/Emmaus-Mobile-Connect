<?php

namespace App\Form;

use App\Entity\Device;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellAssistantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('screenSize', CheckboxType::class, [
                'attr' => [
                    'class'=> 'form-check-input',
                    'class-label'=> 'form-check-label',
                ],
                'label' => 'Senior / confort d\'utilisation',
                'required' => false,
            ])
            ->add('ram', CheckboxType::class, [
                'attr' => [
                    'class'=> 'form-check-input',
                    'class-label'=> 'form-check-label',
                ],
                'label' => "Nombreuses applications simultanées",
                'required' => false,
            ])
            ->add('storage', CheckboxType::class, [
                'attr' => [
                    'class'=> 'form-check-input',
                    'class-label'=> 'form-check-label',
                ],
                'label' => 'Stockage de photos et vidéos',
                'required' => false,
            ])
            ->add('price', CheckboxType::class, [
                'attr' => [
                    'class'=> 'form-check-input',
                    'class-label'=> 'form-check-label',
                ],
                'label' => 'Prix',
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
