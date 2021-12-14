<?php

namespace App\Form;

use App\Entity\Societes;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('raison_sociale', ChoiceType::class, [
                'choices'=>[
                    'EI' => 'ei',
                    'EIRL' => 'eirl',
                    'EURL' => 'eurl',
                    'SARL' => 'sarl',
                    'SA' => 'sa',
                    'SAS' => 'sas',
                    'SASU' => 'sasu',
                    'SNC' => 'snc',
                    'SCOP' => 'scop',
                    'SCA' => 'SCA',
                    'SCS' => 'scss'
                ]
            ])
            ->add('numero_siret')
            ->add('genre_de_societe')
            ->add('email')
            ->add('telephone')
            ->add('site_web')
            ->add('facebook')
            ->add('twitter')
            ->add('autre_infos', CKEditorType::class)
            ->add('projet')
            ->add('adresse_postal')
            ->add('code_postal')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societes::class,
        ]);
    }
}
