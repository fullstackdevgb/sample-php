<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;

class AccountSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('firstName', TextType::class);
        $builder->add('lastName', TextType::class);
        $builder->add('email', TextType::class);
        $builder->add('phone', TextType::class, [
            'label' => 'Phone',
            'required' => false,
            'constraints' => [
                new Constraints\Length([
                    'min' => 10,
                    'max' => 10,
                    'exactMessage' => 'Please enter a valid mobile number.'
                ]),
                new Constraints\Regex([
                    'pattern' => '/^\d+$/',
                    'htmlPattern' => '/^\d+$/',
                    'message' => 'Please enter a valid mobile number.'
                ])
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
