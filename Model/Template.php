<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Template
 *
 * @ORM\Table(name="wh_cms_tplt")
 * @ORM\Entity()
 */
class Template
{


    /**
     * Status de page
     * @var array
     */
	static protected $blocTypes = array(
		'page'       => 'Template page',
        'post'       => 'Template post',
		'bloc'       => 'Template bloc'
	);


    /**
     * @var integer'
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="tplt", type="string", length=255, nullable=true)
     */
    protected $tplt;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="controller", type="string", length=255, nullable=true)
	 */
	protected $controller;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="adminController", type="string", length=255, nullable=true)
	 */
	protected $adminController;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Template
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Template
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return Template
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return string 
     */
    public function getController()
    {
        return $this->controller;
    }


    static public function getBlocTypesChoices()
    {
        return self::$blocTypes;
    }


    /**
     * Set Type
     *
     * @param string $type
     * @return Template
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get Type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set adminController
     *
     * @param string $adminController
     * @return Template
     */
    public function setAdminController($adminController)
    {
        $this->adminController = $adminController;

        return $this;
    }

    /**
     * Get adminController
     *
     * @return string 
     */
    public function getAdminController()
    {
        return $this->adminController;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set tplt
     *
     * @param string $tplt
     * @return Template
     */
    public function setTplt($tplt)
    {
        $this->tplt = $tplt;

        return $this;
    }

    /**
     * Get tplt
     *
     * @return string
     */
    public function getTplt()
    {
        return $this->tplt;
    }

}
