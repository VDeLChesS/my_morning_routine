<?php

namespace App\Controller\Admin;

use App\Entity\Challenges;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ChallengesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Challenges::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            IntegerField::new('points_award'),
            IntegerField::new('duration'),
            DateTimeField::new('start_date')->setFormat('yyyy.MM.dd GGG HH:mm:ss'),
            DateTimeField::new('end_date')->setFormat('yyyy.MM.dd GGG HH:mm:ss'),
        ];
    }
    
}
