<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class WebsitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('main', UrlType::class, [
                'label' => 'URL bazowy'
            ])
            ->add('urls', CollectionType::class, [
                'label' => false,
                'entry_type' => UrlType::class,
                'allow_add' => true,
            ])
            ->add('submit', SubmitType::class)
        ;
    }
}
