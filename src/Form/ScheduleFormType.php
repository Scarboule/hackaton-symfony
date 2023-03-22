<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class ScheduleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_date', DateType::class, [
                'label' => 'Start Date',
                'widget' => 'choice',
                'html5' => false,
            ])
            ->add('end_date', DateType::class, [
                'label' => 'End Date',
                'widget' => 'choice',
                'html5' => false,
            ])
            ->add('schedule', DayFormType::class);
    }
}