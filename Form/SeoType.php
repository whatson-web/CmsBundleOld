<?php

namespace WH\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use WH\CmsBundle\Model\Seo;

class SeoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Balise Meta Title : ','required' => false))
            ->add('alt', 'text', array('label' => 'Balise Meta Alt : ','required' => false))
            ->add('description', 'textarea', array('label' => 'Balise Meta Description : ','required' => false))
            ->add('linkCanonical', 'text', array('label' => 'Lien canonique : ','required' => false))
            ->add('keywords', 'textarea', array('label' => 'Balise meta kewords : ','required' => false))
            ->add('robots', 'choice', array('label' => 'Comportement des robots : ', 'required' => false, 'choices' => Seo::getRobotsChoices()))
            ->add('priority', 'text', array('label' => 'Priorité d’indexation (entre 0,0 et 1,0 - Par default : 0,5)', 'required' => false))
            ->add('changefreq', 'choice', array('label' => 'Fréquence de mise à jour', 'required' => false, 'choices' => Seo::getChangefreqsChoices()))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\CmsBundle\Entity\Seo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_seo';
    }
}

