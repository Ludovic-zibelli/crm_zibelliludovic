<?php

namespace App\Form;

use App\Entity\ClientRecherche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroClient', IntegerType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro de client'
                ]
            ])
            ->add('nomSociete', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de la societé'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClientRecherche::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
