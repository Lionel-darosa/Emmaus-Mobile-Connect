<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\Device;
use App\Entity\Store;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', ChoiceType::class, [
                    'placeholder' => 'Choisissez une option',
                    'label' => 'Modèle',
                    'choices' => Device::PHONE])

            ->add('ram', ChoiceType::class, [
                    'placeholder' => 'Choisissez une option',
                    'label' => 'RAM',
                    'choices' => Device::RAM])

            ->add('storage', ChoiceType::class, [
                    'placeholder' => 'Choisissez une option',
                    'label' => 'Stockage',
                    'choices' => Device::STORAGE])

            ->add('state', ChoiceType::class, [
                    'placeholder' => 'Choisissez une option',
                    'label' => 'État du téléphone',
                    'choices' => Device::STATE])

            ->add('agency', EntityType::class, [
                    'placeholder' => 'Choisissez une option',
                    'label' => 'Magasin Emmaüs',
                    'class' => Agency::class,
                    'choice_label' => 'city'])
                    
            ->add('image', DropzoneType::class)

            // ->add('screen_size', IntegerType::class, [
            //         'placeholder' => 'Choisissez une option',
            //         ])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }
}
