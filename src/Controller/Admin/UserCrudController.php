<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (in_array('ROLE_SUPER_ADMIN', $this->getUser()->getRoles())) {
            return [
                TextField::new('station_name'),
                TextField::new('email'),
                ArrayField::new('roles'),
                ImageField::new('logo_url')
                    ->setUploadDir('public/uploads/images')
                    ->setBasePath('uploads/images')
                    ->setUploadedFileNamePattern('[slug]-[randomhash].[extension]')
                    ->setFormTypeOptions([
                        'attr' => [
                            'accept' => 'image/*'
                        ]
                    ]),
                TextEditorField::new('presentation'),
            ];
        }else{
            return [
                TextField::new('station_name'),
                TextField::new('email'),
                ImageField::new('logo_url')
                    ->setUploadDir('public/uploads/images')
                    ->setBasePath('uploads/images')
                    ->setUploadedFileNamePattern('[slug]-[randomhash].[extension]')
                    ->setFormTypeOptions([
                        'attr' => [
                            'accept' => 'image/*'
                        ]
                    ]),
                TextEditorField::new('presentation'),
            ];
        }
    }

    public function createIndexQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null): \Doctrine\ORM\QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

        if (in_array('ROLE_SUPER_ADMIN', $this->getUser()->getRoles())) {
            return $qb;
        }

        $qb->andWhere('entity.id = :user')
            ->setParameter('user', $this->getUser()->getId());

        return $qb;
    }

    public function configureActions(\EasyCorp\Bundle\EasyAdminBundle\Config\Actions $actions): \EasyCorp\Bundle\EasyAdminBundle\Config\Actions
    {
        if (in_array('ROLE_SUPER_ADMIN', $this->getUser()->getRoles())) {
            return $actions;
        }

        return $actions
            ->disable(Action::NEW, Action::DELETE);
    }
}
