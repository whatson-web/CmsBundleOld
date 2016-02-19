<?php

namespace WH\CmsBundle\Form\Backend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

use WH\CmsBundle\Entity\Page;
use WH\CmsBundle\Entity\PageRepository;
use WH\CmsBundle\Form\PageUpdateType;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('page', new PageUpdateType())

            ->add('mobile', 'text', array('label' => 'Mobile : ', 'required' => false))
            ->add('email', 'text', array('label' => 'Email : ', 'required' => false))
            ->add('phone', 'text', array('label' => 'Phone : ', 'required' => false))
            ->add('adress', 'text', array('label' => 'Adresse : ', 'required' => false))
            ->add('adressCplt', 'text', array('required' => false, 'label' => 'Adresse Cplt : '))
            ->add('zipCode', 'text', array('label' => 'Code postal : ', 'required' => false))
            ->add('town', 'text', array('label' => 'Ville : ', 'required' => false))
            ->add('default', 'checkbox', array('required' => false, 'label' => 'Contact par default '))

            ->add('civility', 'choice', array(
                    'required' => false,
                    'label' => 'Civivilité : ',
                    'choices'   => array(
                        'Mme.' => 'Madame',
                        'M.' => 'Monsieur'
                    )
                ))
            ->add('firstname', 'text', array('label' => 'Prénom : ', 'required' => false))
            ->add('lastname', 'text', array('label' => 'Prénom : ', 'required' => false))
            ->add('LegalForm', 'entity', array(
                    'required' => false,
                    'label' => 'Forme Juridique : ',
                    'class'   => 'APPOrganisationBundle:LegalForm',
                    'property' => 'name'
                ))
            ->add('socialReason', 'text', array('label' => 'Raison sociale : ', 'required' => false))
            ->add('tva_number', 'text', array('label' => 'Numéro tva : ', 'required' => false))
            ->add('siret_number', 'text', array('label' => 'Numéro siret : ', 'required' => false))
            ->add('siren_number', 'text', array('label' => 'Numéro siren : ', 'required' => false))
            ->add('code_ape', 'text', array('label' => 'Code ape : ', 'required' => false))

            ->add('comment', 'textarea', array('label' => 'Resumé (dans le footer) : ', 'required' => false))


        ;


    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\OrganisationBundle\Entity\Organisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wh_cmsbundle_contact';
    }
}
