<?php

namespace App\Controller\Admin;

use App\Entity\UserChallenges;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UserChallengesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserChallenges::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setQueryBuilder(function ($user) {
                return $user->createQueryBuilder('User', 'u')
                    ->orderBy('u.email', 'ASC');
            }),
            AssociationField::new('challenge')->setQueryBuilder(function ($challenge) {
                return $challenge->createQueryBuilder('Challenge', 'c')
                    ->orderBy('c.name', 'ASC');
            }),
            BooleanField::new('is_completed'),
            DateTimeField::new('completion_date')->setFormat('yyyy-MM-dd HH:mm:ss'),
            IntegerField::new('progress'),

        ];
    }
    
}
