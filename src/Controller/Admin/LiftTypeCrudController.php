<?php

namespace App\Controller\Admin;

use App\Entity\LiftType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LiftTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LiftType::class;
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
}
