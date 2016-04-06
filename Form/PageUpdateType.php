<?php

namespace WH\CmsBundle\Form;

use APP\CmsBundle\Entity\Page;
use APP\CmsBundle\Entity\TemplateRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use WH\CmsBundle\Form\Backend\PageBlocType;

/**
 * Class PageUpdateType
 * @package WH\CmsBundle\Form
 */
class PageUpdateType extends PageType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);

        $builder
            ->remove('editer')
            ->remove('new')
            ->add('name', 'text')
            ->add('status', 'choice', array('label' => 'Etat de la page : ', 'choices' => Page::getStatusChoices()))
            ->add('save_and_stay', 'submit', array('label' => 'Enregistrer', 'attr' => array('class' => 'btn btn-success')))
            ->add('save_and_back', 'submit', array('label' => 'Enregistrer et quitter ', 'attr' => array('class' => 'btn btn-primary')))
            ->add('title', 'text', array('label' => 'Titre de la page', 'required' => false))
            ->add('slugReplace', 'text', array('label' => '', 'required' => false))
            ->add('slugTechnique', 'text', array('label' => 'Nom technique (ne change pas)', 'required' => false))
            ->add('url_rewrite', 'text', array('label' => 'Redirection', 'required' => false))
            ->add('resume', 'textarea', array('label' => 'Résumé', 'required' => false))
            ->add('body', 'textarea', array('label' => 'Corp de texte', 'required' => false, 'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')))
            ->add('thumb', new FileType(), array('label' => false, 'required' => false))
            ->add('banner', new FileType(), array('label' => false, 'required' => false))
            ->add('Seo', new SeoType())
            ->add('template', 'entity', array(
                'required'      => false,
                'label'         => 'Template',
                'class'         => 'APPCmsBundle:Template',
                'empty_value'   => 'Page normale',
                'property'      => 'name',
                'query_builder' => function (TemplateRepository $er) {

                        return $er->createQueryBuilder('Template')->andWhere('Template.type = :type')->setParameter('type', 'page');

                    }
            ))
            ->add('pageBlocs', 'collection', array(
                'type'         => new PageBlocType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\CmsBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_page';
    }
}
