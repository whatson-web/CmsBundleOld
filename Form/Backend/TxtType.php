<?php

namespace WH\CmsBundle\Form\Backend;

/**
 * Components
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Entities
 */
use WH\CmsBundle\Entity\Txt;

/**
 * Class ParameterType
 * @package WH\ParameterBundle\Form
 */
class TxtType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', 'text', array('label' => 'Nom technique : '))
            ->add('name', 'text', array('label' => 'Nom : '))
            ->add('valueString', 'text', array('label' => 'Valeur courte : ', 'required' => false))
            ->add('valueLink', 'text', array('label' => 'URL : ', 'required' => false))
            ->add('valueText', 'textarea', array('label' => 'Valeur longue : ', 'required' => false))
            ->add('type', 'choice', array('required' => false, 'label' => 'Type : ', 'choices' => Txt::getTypes()))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => 'WH\CmsBundle\Entity\Txt'
       ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_txt';
    }
}
