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
                'label' => 'Senior / comfort d\'utilisation',
                'required' => false,
            ])
            ->add('ram', CheckboxType::class, [
                'label' => 'Nombreuse appli simultanées',
                'required' => false,
            ])
            ->add('storage', CheckboxType::class, [
                'label' => 'Plus de photo/videos',
                'required' => false,
            ])
            ->add('price', CheckboxType::class, [
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
