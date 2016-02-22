<?php

namespace WH\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', 'elfinder', array('instance'=>'default', 'enable'=>true, 'label' => 'Url : ', 'required' => false))
            ->add('alt', 'text', array('label' => 'Texte alternatif : ', 'required' => false))
            ->add('description', 'textarea', array('label' => 'Balise Description : ', 'required' => false))
            ->add('title', 'text', array('label' => 'Balise title : ', 'required' => false))
            ->add('position', 'hidden')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\CmsBundle\Entity\File'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_file';
    }
}
