<?php

namespace WH\CmsBundle\Model;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use WH\CmsBundle\Model\Content as WHCmsContent;


/**
 * @ORM\MappedSuperclass
 * @ORM\Table()
 * @Gedmo\Tree(type="nested")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity()
 */
abstract class Page extends WHCmsContent
{

    /**
     * Status de page
     * @var array
     */
    static protected $statusChoice = array(
        'published' => 'Publié',
        'draft'     => 'Brouillon'
    );

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Template")
     */
    protected $template;

    /**
     * @ORM\OneToOne(targetEntity="File", cascade={"persist", "remove"})
     */
    protected $thumb;

    /**
     * @ORM\ManyToMany(targetEntity="Menu", mappedBy="pages", cascade={"persist"})
     */
    protected $menus;

    /**
     * @ORM\Column(name="url_rewrite", type="string", length=255, nullable=true)
     */
    protected $url_rewrite;


    /****************************************
     *
     * CHAMP NECESSAIRE A GEDMON TREE
     *
     ****************************************/

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    protected $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    /*
     * Pour les selects
     */
    protected $indentedName;


    /****************************************
     *
     * CONSTRUCTOR
     *
     ****************************************/
    public function __construct()
    {
        parent::__construct();

        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Menus    = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /****************************************
     *
     * AUTO GENERATED
     *
     ****************************************/
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
     * Add children
     *
     * @param $children
     * @return Page
     */
    public function addChild(Page $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param $children
     */
    public function removeChild(Page $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }


    /**
     * Pour les selects en admin
     */
    public function getIndentedName () {

        return str_repeat(" > ", $this->lvl) . $this->name;

    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function mySetUpdate() {

        $this->updated = new \DateTime();


    }


    /**
     * Add Menus
     *
     * @param Menu $menus
     * @return Page
     */
    public function addMenu(Menu $menus)
    {
        $this->menus[] = $menus;

        $menus->addPage($this);

        return $this;
    }

    /**
     * Remove Menus
     *
     * @param Menu $menus
     */
    public function removeMenu(Menu $menus)
    {
        $this->menus->removeElement($menus);

        $menus->removePage($this);

    }

    /**
     * Get Menus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenus()
    {
        return $this->menus;
    }




    /**
     * Set url_rewrite
     *
     * @param string $urlRewrite
     * @return Page
     */
    public function setUrlRewrite($urlRewrite)
    {
        $this->url_rewrite = $urlRewrite;

        return $this;
    }

    /**
     * Get url_rewrite
     *
     * @return string
     */
    public function getUrlRewrite()
    {
        return $this->url_rewrite;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Page
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Page
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Page
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Page
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set template
     *
     * @param Template $template
     * @return Page
     */
    public function setTemplate(Template $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set thumb
     *
     * @param File $thumb
     * @return Page
     */
    public function setThumb(File $thumb = null)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return File
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set parent
     *
     * @param Page $parent
     * @return Page
     */
    public function setParent(Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Page
     */
    public function getParent()
    {
        return $this->parent;
    }
}