<?php

namespace App\Controller\Admin;

use App\Entity\Lift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lift::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

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
