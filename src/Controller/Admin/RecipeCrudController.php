<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            TextField::new('ingredients', 'Ingredients'),
            TextField::new('steps', 'Etapes'),
            IntegerField::new('preparationTime', 'Temps de préparation'),
            IntegerField::new('cookingTime', 'Temps de cuisson'),
            IntegerField::new('timeOfRest', 'Temps de repos'),
            ImageField::new('picture', 'Image')
                ->setBasePath('assets/images/Recipes/')
                ->setUploadDir('public/assets/images/Recipes')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('allergenType', 'Allergènes'),
            AssociationField::new('dietType', 'Régimes alimentaires'),
            BooleanField::new("isAccessible", 'Uniquement pour les patients'),
        ];
    }
}
