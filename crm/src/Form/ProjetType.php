<?php

namespace App\Form;

use App\Entity\Projet;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type_projet')
            ->add('langage')
            ->add('avancement_projet', ChoiceType::class,[
                'choices' => [
                    'Phase d\'initialisation' => 'intialisation',
                    'Phase de lancement' => 'lancement',
                    'Phase de conception' => 'conception',
                    'Phase de production' => 'production',
                    'Phase d\'exploitation' => 'exploitation',
                    'Contrat de maintenance' => 'maintenance'
                ]
            ])
            ->add('description_projet', CKEditorType::class)
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En cours' => false,
                    'Terminer' => true
                ]
            ])
            ->add('societe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
