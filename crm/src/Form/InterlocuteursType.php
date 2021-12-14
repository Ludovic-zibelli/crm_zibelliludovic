<?php

namespace App\Form;

use App\Entity\Interlocuteurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterlocuteursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('poste')
            ->add('email')
            ->add('telephone')
            ->add('societe')
            ->add('skype')
            ->add('linkedin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Interlocuteurs::class,
        ]);
    }
}
