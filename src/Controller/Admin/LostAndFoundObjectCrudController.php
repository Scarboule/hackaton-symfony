<?php

namespace App\Controller\Admin;

use App\Entity\LostAndFoundObject;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LostAndFoundObjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LostAndFoundObject::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('description'),
            AssociationField::new('slope'),
            DateTimeField::new('found_date')
        ];
    }
}
