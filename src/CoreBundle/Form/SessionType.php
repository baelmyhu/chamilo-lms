<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Form;

<<<<<<< HEAD
use Chamilo\CoreBundle\Entity\Session;
=======
use Chamilo\CoreBundle\Entity\Promotion;
use Chamilo\CoreBundle\Entity\Session;
use Chamilo\CoreBundle\Entity\SessionCategory;
use Chamilo\CoreBundle\Entity\User;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @template-extends AbstractType<Session>
 */
class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', 'text')
            ->add(
                'general_coach',
                'entity',
                [
<<<<<<< HEAD
                    'class' => 'ChamiloCoreBundle:User',
=======
                    'class' => User::class,
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                    'property' => 'username',
                ]
            )
            ->add(
                'session_admin_id',
                'entity',
                [
<<<<<<< HEAD
                    'class' => 'ChamiloCoreBundle:User',
=======
                    'class' => User::class,
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                    'property' => 'username',
                ]
            )
            ->add(
                'visibility',
                'choice',
                [
                    'choices' => Session::getStatusList(),
                ]
            )
            ->add(
                'session_category_id',
                'entity',
                [
<<<<<<< HEAD
                    'class' => 'ChamiloCoreBundle:SessionCategory',
=======
                    'class' => SessionCategory::class,
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                    'property' => 'name',
                ]
            )
            ->add(
                'promotion_id',
                'entity',
                [
<<<<<<< HEAD
                    'class' => 'ChamiloCoreBundle:Promotion',
=======
                    'class' => Promotion::class,
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                    'property' => 'name',
                ]
            )
            ->add('display_start_date', 'sonata_type_datetime_picker')
            ->add('display_end_date', 'sonata_type_datetime_picker')
            ->add('access_start_date', 'sonata_type_datetime_picker')
            ->add('access_end_date', 'sonata_type_datetime_picker')
            ->add('coach_access_start_date', 'sonata_type_datetime_picker')
            ->add('coach_access_end_date', 'sonata_type_datetime_picker')
            ->add('save', 'submit', [
                'label' => 'Update',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Session::class,
            ]
        );
    }

    public function getName(): string
    {
        return 'session';
    }
}
