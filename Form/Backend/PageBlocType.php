<?php

namespace WH\CmsBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use APP\CmsBundle\Entity\TemplateRepository;
use WH\CmsBundle\Form\FileLittleType;

class PageBlocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('attr' => array('placeholder' => 'Titre'), 'required' => false, 'label' => false))
            ->add('position', 'hidden')
            ->add('body', 'textarea', array('attr' => array('placeholder' => 'Valeur texte', 'class' => 'tinymce'), 'required' => false, 'label' => false))
            ->add('thumb', new FileLittleType(), array('label' => false, 'required' => false))
            ->add('bloc', 'entity', array(
                    'label'     => false,
                    'class'     => 'WHCmsBundle:Bloc',
                    'property'  => 'name',
                    'required'  => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WH\CmsBundle\Entity\PageBloc'
         ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_page_bloc';
    }
}
