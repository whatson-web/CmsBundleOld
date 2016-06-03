<?php

namespace WH\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bloc
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bloc
{


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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="backendController", type="string", length=255, nullable=true)
     */
    private $backendController;

    /**
     * @var string
     *
     * @ORM\Column(name="frontendAction", type="string", length=255, nullable=true)
     */
    private $frontendAction;

    /**
     * @var string
     *
     * @ORM\Column(name="view", type="string", length=255)
     */
    private $view;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="APP\CmsBundle\Entity\Template")
     */
    private $template;

    /**
     * @var array
     *
     * @ORM\Column(name="datas", type="array", nullable=true)
     */
    private $datas;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="APP\CmsBundle\Entity\File", mappedBy="bloc", cascade={"persist", "remove"})
     */
    private $files;


    public function __construct()
    {
        $this->datas = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Bloc
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
     * @return Bloc
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
     * Set datas
     *
     * @param array $datas
     * @return Bloc
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;

        return $this;
    }

    /**
     * Get datas
     *
     * @return array 
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * Set view
     *
     * @param string $view
     * @return Bloc
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return string 
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set template
     *
     * @param \APP\CmsBundle\Entity\Template $template
     * @return Bloc
     */
    public function setTemplate(\APP\CmsBundle\Entity\Template $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return \APP\CmsBundle\Entity\Template 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Bloc
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add files
     *
     * @param \APP\CmsBundle\Entity\File $files
     * @return Bloc
     */
    public function addFile(\APP\CmsBundle\Entity\File $files)
    {
        $this->files[] = $files;

        $files->setBloc($this);

        return $this;
    }

    /**
     * Remove files
     *
     * @param \APP\CmsBundle\Entity\File $files
     */
    public function removeFile(\APP\CmsBundle\Entity\File $files)
    {
        $this->files->removeElement($files);

        $files->setBloc(null);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }


    /**
     * Set backendController
     *
     * @param string $backendController
     * @return Bloc
     */
    public function setBackendController($backendController)
    {
        $this->backendController = $backendController;

        return $this;
    }

    /**
     * Get backendController
     *
     * @return string 
     */
    public function getBackendController()
    {
        return $this->backendController;
    }

    /**
     * Set frontendAction
     *
     * @param string $frontendAction
     * @return Bloc
     */
    public function setFrontendAction($frontendAction)
    {
        $this->frontendAction = $frontendAction;

        return $this;
    }

    /**
     * Get frontendAction
     *
     * @return string 
     */
    public function getFrontendAction()
    {
        return $this->frontendAction;
    }
}
