<?php

	namespace WH\CmsBundle\Form;

	/**
	 * Components
	 */
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;

	/**
	 * Entities
	 */
	use WH\CmsBundle\Model\Content;

	/**
	 * Class ContentUpdateType
	 * @package WH\CmsBundle\Form
	 */
	class ContentUpdateType extends AbstractType
	{
	    /**
	     * @param FormBuilderInterface $builder
	     * @param array $options
	     */
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {

	        $builder
		        ->add('name', 'text', array('label' => 'Nom : '))
		        ->add('title', 'text', array('label' => 'Titre : ', 'required' => false))
		        ->add('resume', 'textarea', array('label' => 'Résumé : ', 'required' => false))
		        ->add('body', 'genemu_tinymce', array('label' => 'Contenu', 'required' => false))
		        ->add('status', 'choice', array('label' => 'Etat de la page : ', 'choices' => Content::getStatusChoices()))
		        ->add('thumb', new FileType(), array('label' => 'Miniature', 'required' => false))
		        ->add('slugReplace', 'text', array('label' => 'Réécriture du slug : ', 'required' => false))
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
	        return 'wh_cmsbundle_content_udpate';
	    }

	}
