<?php

namespace WH\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Txt
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Txt
{

	public static $types = array(
		'link'     => 'Lien',
		'input'    => 'Valeur courte',
		'textarea' => 'Valeur longue',
	);

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string", length=255)
	 */
	private $slug;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", length=255)
	 */
	private $type;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="value_string", type="string", length=255, nullable=true)
	 */
	private $valueString;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="value_link", type="string", length=255, nullable=true)
	 */
	private $valueLink;

    /**
     * @var text
     *
     * @ORM\Column(name="value_text", type="text", nullable=true)
     */
    private $valueText;


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
     * @return Txt
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
     * Set value_string
     *
     * @param string $valueString
     * @return Txt
     */
    public function setValueString($valueString)
    {
        $this->valueString = $valueString;

        return $this;
    }

    /**
     * Get value_string
     *
     * @return string 
     */
    public function getValueString()
    {
        return $this->valueString;
    }

    /**
     * Set valueText
     *
     * @param string $valueText
     * @return Txt
     */
    public function setValueText($valueText)
    {
        $this->valueText = $valueText;

        return $this;
    }

    /**
     * Get valueText
     *
     * @return string 
     */
    public function getValueText()
    {
        return $this->valueText;
    }

    /**
     * Set valueLink
     *
     * @param string $valueLink
     * @return Txt
     */
    public function setValueLink($valueLink)
    {
        $this->valueLink = $valueLink;

        return $this;
    }

    /**
     * Get valueLink
     *
     * @return string 
     */
    public function getValueLink()
    {
        return $this->valueLink;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Txt
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

	public static function getTypes()
	{

		return self::$types;

	}


    /**
     * Set type
     *
     * @param string $type
     * @return Txt
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
