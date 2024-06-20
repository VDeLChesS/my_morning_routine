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
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField; 
use DateTime;
class ActivitiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Activities::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $currentDate = new DateTime("now");
        $isCompleted = false;
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ChoiceField::new('category')->setChoices(['Sports' => 'Sports', 'Education' => 'Education', 'Programming' => 'Programming', 'Friends' => 'Friends', 'Family' => 'Family', 'Health' => 'Health', 'Hobbies' => 'Hobbies', 'Work' => 'Work', 'Other' => 'Other']),
            TextEditorField::new('description'),
            IntegerField::new('duration'),
            BooleanField::new('is_completed')->hideOnForm()->setValue($isCompleted),
            DateTimeField::new('created_at')->hideOnForm()->hideOnIndex()->hideOnDetail()->setValue($currentDate),
            DateTimeField::new('updated_at')->hideOnForm()->hideOnIndex()->hideOnDetail()->setValue($currentDate),
        ];
    }
    
}
