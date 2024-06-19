<?php

namespace App\Controller\Admin;

use App\Entity\MorningRoutines;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class MorningRoutinesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MorningRoutines::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setQueryBuilder(function ($user) {
                return $user->createQueryBuilder('User', 'u')
                    ->orderBy('u.email', 'ASC');
            }),
            TextField::new('name'),
            BooleanField::new('active'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

}
