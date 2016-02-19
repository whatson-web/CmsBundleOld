<?php

namespace WH\CmsBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use APP\CmsBundle\Entity\Template;


class TemplateType extends AbstractType
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
            ->add('tplt', 'text', array('label' => 'Vue : ', 'required' => false))
            ->add('controller', 'text', array('label' => 'Controller : ', 'required' => false))
            ->add('adminController', 'text', array('label' => 'Controller Admin : ', 'required' => false))
            ->add('req', 'textarea', array('label' => 'Requette : ', 'required' => false))
            ->add('Type', 'choice', array(
                    'label' => 'Type : ',
                    'choices' => Template::getBlocTypesChoices()
                )

            )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'APP\CmsBundle\Entity\Template'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cms_template';
    }

}
