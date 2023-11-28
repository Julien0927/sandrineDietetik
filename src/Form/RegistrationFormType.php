<?php

namespace App\Form;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use App\Entity\AllergenType;
use App\Entity\DietType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use PharIo\Manifest\Email;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                    "label" => "Prénom"
                    ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                    "label" => "Nom"
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                    "label" => "E-mail"
            ])
            ->add('roles', CollectionType::class, [
                'entry_type' => TextType::class, // Le type des éléments dans le tableau (ici, TextType)
                'allow_add' => true, // Permet d'ajouter de nouveaux éléments au tableau
                'allow_delete' => true, // Permet de supprimer des éléments du tableau
                'entry_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                ],
                    "label" => "Rôle"
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                    "label" => "Mot de passe"
            ])
            ->add('allergenType', EntityType::class, [
                'class' => AllergenType::class,
                'choice_label' => 'type',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                
                    "label" => "Allergènes"
            ])
            ->add('dietType', EntityType::class, [
                'class' => DietType::class,
                'choice_label' => 'type',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                
                    "label" => "Régimes"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
