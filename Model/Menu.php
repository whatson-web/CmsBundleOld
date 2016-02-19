<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var integer
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Page", inversedBy="menus")
     */
    protected $pages;



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
     * @return Menu
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
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Pages
     *
     * @param \APP\CmsBundle\Entity\Page $pages
     * @return Menu
     */
    public function addPage(\APP\CmsBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;

        return $this;
    }

    /**
     * Remove Pages
     *
     * @param \APP\CmsBundle\Entity\Page $pages
     */
    public function removePage(\APP\CmsBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get Pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Menu
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
}
