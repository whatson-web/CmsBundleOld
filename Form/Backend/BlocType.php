<?php

namespace WH\CmsBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom : '))
            ->add('slug', 'text', array('label' => 'Nom technique : '))
            ->add('backendController', 'text', array('label' => 'Controller admin : '))
            ->add('frontendAction', 'text', array('label' => 'Action du render front offrice (APPCmsBundle:Bloc:MonBloc) : '))
            ->add('view', 'text', array('label' => 'Vue du front (facultatif) : '))
            ->add('description', 'textarea', array('label' => 'Description : '))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WH\CmsBundle\Entity\Bloc',
            'required' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_bloc';
    }
}
