<?php

namespace App\Controller\Admin;

use App\Entity\Lift;
use App\Form\ScheduleFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lift::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('station'),
            AssociationField::new('type'),
            BooleanField::new('manual_open')->setLabel('Ouverture manuelle'),
            BooleanField::new('manual_close')->setLabel('Fermeture manuelle'),
            TextField::new('message'),
            CollectionField::new('schedule')
                ->setLabel('Horaires')
                ->setEntryType(ScheduleFormType::class)
        ];
    }

    public function createIndexQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null): \Doctrine\ORM\QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

        if (in_array('ROLE_SUPER_ADMIN', $this->getUser()->getRoles())) {
            return $qb;
        }

        $qb->andWhere('entity.station = :user')
            ->setParameter('user', $this->getUser());

        return $qb;
    }
}
