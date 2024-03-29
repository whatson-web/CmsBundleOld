<?php

namespace WH\CmsBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use WH\CmsBundle\Form\FileType;

class BlocMediaType extends AbstractType
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
            ->add('view', 'text', array('label' => 'Nom de la vue : '))
            ->add('description', 'textarea', array('label' => 'Description : '))
            ->add('files', 'collection', array(
                    'type'          => new FileType(),
                    'allow_add'     => true,
                    'allow_delete'  => true,
                    'by_reference'  => false
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WH\CmsBundle\Entity\Bloc'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_bloc_media';
    }
}
