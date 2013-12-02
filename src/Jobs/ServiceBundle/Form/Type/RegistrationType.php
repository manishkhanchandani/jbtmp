<?php

// src/Jobs/ServiceBundle/Form/Type/RegistrationType.php
namespace Jobs\ServiceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('users', new UsersType());
        $builder->add(
            'terms',
            'checkbox',
            array('property_path' => 'termsAccepted')
        );
        $builder->add('save', 'submit');
    }

    public function getName()
    {
        return 'registration';
    }
}