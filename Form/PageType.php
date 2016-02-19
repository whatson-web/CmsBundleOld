<?php

namespace WH\CmsBundle\Form;

/**
 * Components
 */
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use APP\CmsBundle\Entity\PageRepository;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', 'text', array('label' => 'Nom de la page : '))

            ->add('parent', 'entity', array(
                'required' => false,
                'label' => 'Page parente',
                'class' => 'APPCmsBundle:Page',
                'empty_value' => 'Pas de page parente',
                'property' => 'indentedName',
                'multiple' => false,
                'expanded' => false,
                'query_builder' => function(PageRepository $er) {

                    return $er->getChildrenQueryBuilder(null, null, 'root', 'asc', false);

                 }
            ))

            ->add('Menus', 'entity', array(
                    'required'      => false,
                    'label'         => 'Menu(s)',
                    'class'         => 'APPCmsBundle:Menu',
                    'empty_value'   => 'Pas de menu',
                    'property'      => 'name',
                    'attr'          => array('class' => 'select2', 'style' => 'width:100%'),
                    'multiple'      => true,
                    'expanded'      => false,
                    'by_reference'  => false
                ))

            ->add('editer', 'submit', array('label' => 'Créer et editer', 'attr' => array('class' => 'btn btn-primary')))
            ->add('new', 'submit', array('label' => 'Créer ', 'attr' => array('class' => 'btn btn-success')))
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
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
