<?php

namespace App\Form;

use App\Entity\ProjetsRecheche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetsRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroProjet', IntegerType::class,[
                'label' => false,
                'required' => false,
                'attr' =>[
                    'placeholder' => 'Numéro du projet'
                ]
            ])
            ->add('nomProjet', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom du projet'
                ]
            ])
            ->add('societe', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' =>[
                    'placeholder' => 'Filter par sociéte'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjetsRecheche::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
