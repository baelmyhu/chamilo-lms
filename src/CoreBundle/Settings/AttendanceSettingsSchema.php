<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Settings;

use Chamilo\CoreBundle\Form\Type\YesNoType;
use Sylius\Bundle\SettingsBundle\Schema\AbstractSettingsBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class AttendanceSettingsSchema extends AbstractSettingsSchema
{
    public function buildSettings(AbstractSettingsBuilder $builder): void
    {
        $builder
            ->setDefaults(
                [
                    'allow_delete_attendance' => 'true',
                    'enable_sign_attendance_sheet' => 'false',
                    'attendance_calendar_set_duration' => 'false',
                    'attendance_allow_comments' => 'false',
<<<<<<< HEAD
=======
                    'multilevel_grading' => 'false',
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                ]
            )
//            ->setAllowedTypes(
//                array()
//            )
        ;
    }

    public function buildForm(FormBuilderInterface $builder): void
    {
        $builder
<<<<<<< HEAD
            ->add(
                'allow_delete_attendance',
                YesNoType::class,
                [
                    'label' => 'AttendanceDeletionEnableTitle',
                    'help' => 'AttendanceDeletionEnableComment',
                ]
            )
            ->add('enable_sign_attendance_sheet', YesNoType::class)
            ->add('attendance_calendar_set_duration', YesNoType::class)
            ->add('attendance_allow_comments', YesNoType::class)
=======
            ->add('allow_delete_attendance', YesNoType::class)
            ->add('enable_sign_attendance_sheet', YesNoType::class)
            ->add('attendance_calendar_set_duration', YesNoType::class)
            ->add('attendance_allow_comments', YesNoType::class)
            ->add('multilevel_grading', YesNoType::class)
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        ;

        $this->updateFormFieldsFromSettingsInfo($builder);
    }
}
