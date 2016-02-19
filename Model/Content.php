<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Content
{

    public function __construct()
    {

        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
        $this->setStatus('draft');

    }

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Status
     *
     * @var array
     */
    static protected $statusChoice = array(
        'published' => 'Publié',
        'draft'     => 'Brouillon'
    );

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_replace", type="string", length=255, nullable=true)
     */
    protected $slugReplace;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_technique", type="string", length=255, nullable=true)
     */
    protected $slugTechnique;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @var string
     * @ORM\Column(name="route", type="string", length=255, nullable=true)
     */
    protected $route;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    protected $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    protected $body;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    protected $status;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updated;

    /**
     * @var \DateTime $contentChanged
     *
     * @ORM\Column(name="content_changed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"title", "body"})
     */
    protected $contentChanged;

    /**
     * @ORM\OneToOne(targetEntity="APP\CmsBundle\Entity\Seo", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    protected $seo;

    /**
     * @ORM\ManyToOne(targetEntity="APP\UserBundle\Entity\User")
     */
    protected $author;


    /****************************************
     *
     * MY FUNCTIONS
     *
     ****************************************/

    /**
     * @return array
     */
    static public function getStatusChoices()
    {

        return self::$statusChoice;
    }


    /**
     * Permet de récupérer le bon slug suivant les cas
     *
     */
    public function getMySlug()
    {

        $t = $this->getSlugReplace();

        if(!empty($t)) {

            return $this->getSlugReplace();

        }else{

            return $this->getSlug();

        }

    }

    /**
     * Set slugTechnique
     *
     * @param string $slugTechnique
     * @return Page
     */
    public function setSlugTechnique($slugTechnique)
    {
        $this->slugTechnique = $slugTechnique;

        return $this;
    }

    /**
     * Get slugTechnique
     *
     * @return string
     */
    public function getSlugTechnique()
    {

        return (empty($this->slugTechnique)) ? $this->slug : $this->slugTechnique;
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
     * Set name
     *
     * @param string $name
     * @return Content
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
     * @return Content
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
     * Set slugReplace
     *
     * @param string $slugReplace
     * @return Content
     */
    public function setSlugReplace($slugReplace)
    {
        $this->slugReplace = $slugReplace;

        return $this;
    }

    /**
     * Get slugReplace
     *
     * @return string 
     */
    public function getSlugReplace()
    {
        return $this->slugReplace;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Content
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return Content
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Content
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return Content
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Content
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Content
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function mySetUpdate() {

        $this->updated = new \DateTime();


    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Content
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Content
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set contentChanged
     *
     * @param \DateTime $contentChanged
     * @return Content
     */
    public function setContentChanged($contentChanged)
    {
        $this->contentChanged = $contentChanged;

        return $this;
    }

    /**
     * Get contentChanged
     *
     * @return \DateTime 
     */
    public function getContentChanged()
    {
        return $this->contentChanged;
    }


    /**
     * Set seo
     *
     * @param Seo $seo
     * @return Content
     */
    public function setSeo(Seo $seo = null)
    {
        $this->seo = $seo;

        return $this;
    }

    /**
     * Get seo
     *
     * @return Seo 
     */
    public function getSeo()
    {
        return $this->seo;
    }


    /**
     * Set thumb
     *
     * @param \APP\UserBundle\Entity\User
     * @return Content
     */
    public function setAuthor(\APP\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return \APP\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

}
