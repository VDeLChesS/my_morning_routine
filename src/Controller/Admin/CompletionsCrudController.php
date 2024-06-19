<?php

namespace App\Controller\Admin;

use App\Entity\Completions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
class CompletionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Completions::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setQueryBuilder(function ($user) {
                return $user->createQueryBuilder('User', 'u')
                    ->orderBy('u.email', 'ASC');
            }),
            AssociationField::new('user_challenges')->setQueryBuilder(function ($userChallenges) {
                return $userChallenges->createQueryBuilder('UserChallenges', 'uc')
                    ->where('uc.is_completed = 1')
                    ->setParameter('is_completed', 1)
                    ->orderBy('uc.name', 'ASC');
            }),
            DateTimeField::new('completed_at'),
        ];
    }
    
}
