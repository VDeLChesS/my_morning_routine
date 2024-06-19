<?php

namespace App\Controller\Admin;

use App\Entity\RoutineActivities;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class RoutineActivitiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoutineActivities::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('morningRoutine')->setQueryBuilder(function ($morningRoutine) {
                return $morningRoutine->createQueryBuilder('MorningRoutine', 'mr')
                    ->orderBy('mr.name', 'ASC');
            }),
            AssociationField::new('activity')->setQueryBuilder(function ($activity) {
                return $activity->createQueryBuilder('Activity', 'a')
                    ->orderBy('a.name', 'ASC');
            }),
            IntegerField::new('activity_order'),        
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
}
