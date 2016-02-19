<?php

	namespace WH\CmsBundle\Form;

	/**
	 * Components
	 */
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;

	/**
	 * Class ContentCreateType
	 * @package WH\CmsBundle\Form
	 */
	class ContentCreateType extends AbstractType
	{
	    /**
	     * @param FormBuilderInterface $builder
	     * @param array $options
	     */
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {

	        $builder
		        ->add('name', 'text', array('label' => 'Nom : '))
	        ;

	    }

		/**
		 * @param OptionsResolver $resolver
		 */
		public function configureOptions(OptionsResolver $resolver)
		{
			$resolver->setDefaults(array(
				'data_class' => 'WH\CmsBundle\Entity\Content'
			));
		}

	    /**
	     * @return string
	     */
	    public function getName()
	    {
	        return 'wh_cmsbundle_content_create';
	    }

	}
