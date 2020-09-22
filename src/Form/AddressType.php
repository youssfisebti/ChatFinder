<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetNumber')
            ->add('streetName')
            ->add('streetComplementary')
            ->add('zipCode')
            ->add('longitude')
            ->add('latitude')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('city')
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'countryName',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }

    public function getName()
    {
        return 'address';
    }
}
