<?php

namespace App\Form;

use App\Entity\Score;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('opinion', TextType::class,
                [
                    'label' => 'Laissez votre avis',
                    'attr' => [
                        'rows' => '6',
                        'cols' => '10',
                        'placeholder' => 'Saisissez votre avis',
                        'class' => 'form-control'
                    ]
                ])
            ->add('note', ChoiceType::class, 
                [
                    'attr' => [
                        'placeholder' => 'Votre note',
                        'class' => 'form-control'
                    ],
                        'choices' => [
                            'Cliquez pour sélectionner une note' => null,
                            '1-Je n\'ai pas aimé' => '1',
                            '2-Moyen' => '2',
                            '3-Bon' => '3',
                            '4-Très bon' => '4',
                            '5-Excellent' => '5'
                        ]
                ])
            ->add('envoyer', SubmitType::class, 
                [
                    'label' => 'Envoyer',
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Score::class,
        ]);
    }
}
