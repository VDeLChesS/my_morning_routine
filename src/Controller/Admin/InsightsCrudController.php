<?php

namespace App\Controller\Admin;

use App\Entity\Insights;
use App\Entity\User;
use App\Repository\UserChallengesRepository;
use App\Repository\ActivitiesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class InsightsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Insights::class;
    }

    public function getTotalCompletedActivities(User $current_user, ActivitiesRepository $completedActivities): int
    {
        $current_user = $this->getUser();
        $totalCompletedActivities = $this->$completedActivities->createQueryBuilder('Activities', 'a')
            ->where('a.user = :user')
            ->andWhere('a.is_completed = 1')
            ->setParameter('user', $current_user)
            ->getQuery()
            ->getResult();
        return $totalCompletedActivities;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setQueryBuilder(function ($user) {
                return $user->createQueryBuilder('User', 'u')
                    ->orderBy('u.email', 'ASC');
            }),
            DateField::new('date')->setFormat('yyyy.MM.dd'),
            IntegerField::new('total_completed_activities')
                ->formatValue(function ($entity) {
                    return $entity->getTotalCompletedActivities();
                }),
            IntegerField::new('total_points')
                ->formatValue(function ($entity) {
                    return $entity->countTotalPointsByUserChallenges();
                }),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
}
