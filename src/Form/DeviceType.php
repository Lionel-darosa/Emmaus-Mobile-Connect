<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\Device;
use App\Entity\Store;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('model', ChoiceType::class, [
                    'placeholder' => 'Choose an option',
                    'choices' => Device::PHONE])

            ->add('ram', ChoiceType::class, [
                    'placeholder' => 'Choose an option',
                    'choices' => Device::RAM])

            ->add('storage', ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices' => Device::STORAGE])

            ->add('condition', ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices' => Device::STATE])
                
            // ->add('agencies', EntityType::class, [
            //     'class' => Agency::class,
            //     'choice_label' => 'name',
            //     'multiple' => false,
            //     'expanded' => true,
        //  ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }
}
