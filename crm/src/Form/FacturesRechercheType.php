<?php

namespace App\Form;

use App\Entity\FactureRecherche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FacturesRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroFacture', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro de facture'
                ]
            ])
            ->add('projet', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de projet'
                ]
            ])
            ->add('factureDevis', ChoiceType::class,[
                'choices' =>[
                    'Facture' => false,
                    'Devis' => true
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FactureRecherche::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
