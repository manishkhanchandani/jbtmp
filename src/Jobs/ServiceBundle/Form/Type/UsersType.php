<?php
//src/Jobs/ServiceBundle/Form/Type/UsersType.php
namespace Jobs\ServiceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email');
        $builder->add('password', 'repeated', array(
           'first_name'  => 'password',
           'second_name' => 'confirm',
           'type'        => 'password',
        ));
        $builder->add('firstname', 'text');
        $builder->add('lastname', 'text');
        $builder->add('user_type', 'user_type');
        $builder->add('user_type', 'choice', array(
            'choices'   => array(1 => 'a Job Seeker', 2 => 'an Employer', 3 => 'a Staffing Agency Representative'),
            'required'  => false,
        ));
        $builder->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jobs\ServiceBundle\Entity\Users'
        ));
    }

    public function getName()
    {
        return 'users';
    }
}//end class
