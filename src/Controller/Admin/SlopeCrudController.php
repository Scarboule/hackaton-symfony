<?php

namespace App\Controller\Admin;

use App\Entity\Slope;
use App\Form\ScheduleFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SlopeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slope::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('station'),
            ChoiceField::new('difficulty')->setChoices([
                'Verte' => 'green',
                'Bleue' => 'blue',
                'Rouge' => 'red',
                'Noire' => 'black',
            ])->setLabel('Difficulté'),
            BooleanField::new('manual_open')->setLabel('Ouverture manuelle'),
            BooleanField::new('manual_close')->setLabel('Fermeture manuelle'),
            TextField::new('message'),
            CollectionField::new('schedule')
                ->setLabel('Horaires')
                ->setEntryType(ScheduleFormType::class)
        ];
    }

    public function createEntity(string $entityFqcn): Slope
    {
        $entity = new Slope();
        $entity->setStation($this->getUser());

        return $entity;
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
