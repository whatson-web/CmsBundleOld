<?php
// src/WH/CmsBundle/Form/ImageType.php

namespace WH\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'elfinder', array('instance'=>'default', 'enable'=>true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'WH\CmsBundle\Entity\Image'
            ));
    }

    public function getName()
    {
        return 'wh_cmsbundle_image';
    }
}