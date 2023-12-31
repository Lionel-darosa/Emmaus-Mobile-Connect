<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\Device;
use App\Entity\Store;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
                    
            ->add('screen_size', TextType::class, [
                'label' => 'Taille de l\'écran',
                ])

            ->add('imageFile', DropzoneType::class, [ //VichImageType
                'label' => 'Image du téléphone',
                'required' => false,  
                ])  
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
