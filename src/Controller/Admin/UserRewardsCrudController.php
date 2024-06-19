<?php

namespace App\Controller\Admin;

use App\Entity\UserRewards;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UserRewardsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserRewards::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setQueryBuilder(function ($user) {
                return $user->createQueryBuilder('User', 'u')
                    ->orderBy('u.email', 'ASC');
            }),
            AssociationField::new('reward')->setQueryBuilder(function ($reward) {
                return $reward->createQueryBuilder('Reward', 'r')
                    ->orderBy('r.name', 'ASC');
            }),
            DateTimeField::new('earned_at')->setFormat('yyyy-MM-dd HH:mm:ss'),
        ];
    
    }
}
