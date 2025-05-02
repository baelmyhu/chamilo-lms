<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
=======
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @template T of object
 *
 * @extends AbstractType<T>
 */
class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
<<<<<<< HEAD
                'label' => 'Current Password',
                'required' => true,
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'New Password',
                'required' => true,
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirm New Password',
                'required' => true,
=======
                'label' => 'Current password',
                'required' => false,
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'New password',
                'required' => false,
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirm new password',
                'required' => false,
            ])
            ->add('enable2FA', CheckboxType::class, [
                'label' => 'Enable two-factor authentication (2FA)',
                'required' => false,
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'change_password',
        ]);
    }
}
