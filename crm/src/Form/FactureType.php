<?php

namespace App\Form;

use App\Entity\Factures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_de_facture')
            ->add('facture_devis', ChoiceType::class,[
                'choices'=> [
                    'Devis' => true,
                    'Facture' => false
                ]
            ])
            ->add('date_de_paiement', DateType::class,[
                'label' => 'Date de paiement',
                'widget' => 'single_text',
                'attr' => ['placeholder' => 'placeholder_1','class' => 'js-pickadate-facture']])
            ->add('payer', ChoiceType::class,[
                'choices'=> [
                    'Non' => true,
                    'Oui' => false
                ]
            ])
            ->add('montant_facture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Factures::class,
        ]);
    }
}
