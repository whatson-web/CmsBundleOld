<?php

namespace WH\CmsBundle\Form;

/**
 * Components
 */
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use WH\CmsBundle\Form\FileType;

/**
 * Class BlocCollectionType
 * @package WH\CmsBundle\Form
 */
class BlocCollectionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'files',
                'collection',
                array(
                    'type'         => new FileType(),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
                )
            );

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'WH\CmsBundle\Entity\BlocCollection'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_bloccollection';
    }

}