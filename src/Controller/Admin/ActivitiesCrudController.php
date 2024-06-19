<?php

namespace App\Controller\Admin;

use App\Entity\Activities;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ActivitiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Activities::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ChoiceField::new('category')->setChoices(['Sports' => 'Sports', 'Education' => 'Education', 'Programming' => 'Programming', 'Friends' => 'Friends', 'Family' => 'Family', 'Health' => 'Health', 'Hobbies' => 'Hobbies', 'Work' => 'Work', 'Other' => 'Other']),
            TextEditorField::new('description'),
            IntegerField::new('duration'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
    
}
