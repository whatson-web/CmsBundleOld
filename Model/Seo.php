<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Seo
{

    /**
     * Comportement des robots
     * @var array
     */
    static protected $robotsChoice = array(
        'INDEX, FOLLOW'     => 'Indexer la page et suivre les liens',
        'NOINDEX, FOLLOW'   => 'Ne pas indexer la page et suivre les liens',
        'INDEX, NOFOLLOW'   => 'Indexer la page mais ne pas suivre les liens',
        'NOINDEX, NOFOLLOW' => 'Ne pas indexer la page, et ne pas suivre les liens'
    );

    /**
     * Fréquence de mise à jour
     * @var array
     */
    static protected $changefreqsChoice = array(
        'always'    => 'Tout le temps',
        'hourly'    => 'Toutes les heures',
        'daily'     => 'Tous les jours',
        'weekly'    => 'Tous les semaines',
        'monthly'   => 'Tous les mois',
        'yearly'    => 'Tous les ans',
        'never'     => 'jamais',
    );


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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;


    /**
     * C'est plus pour les images / medias ça
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    protected $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="linkCanonical", type="string", length=255, nullable=true)
     */
    protected $linkCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
     */
    protected $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="robots", type="string", length=255, nullable=true)
     */
    protected $robots;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=255, nullable=true)
     */
    protected $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="changefreq", type="string", length=255, nullable=true)
     */
    protected $changefreq;


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
     * Set title
     *
     * @param string $title
     * @return Seo
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
     * Set description
     *
     * @param string $description
     * @return Seo
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
     * Set linkCanonical
     *
     * @param string $linkCanonical
     * @return Seo
     */
    public function setLinkCanonical($linkCanonical)
    {
        $this->linkCanonical = $linkCanonical;

        return $this;
    }

    /**
     * Get linkCanonical
     *
     * @return string 
     */
    public function getLinkCanonical()
    {
        return $this->linkCanonical;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Seo
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set robots
     *
     * @param string $robots
     * @return Seo
     */
    public function setRobots($robots)
    {
        $this->robots = $robots;

        return $this;
    }

    /**
     * Get robots
     *
     * @return string 
     */
    public function getRobots()
    {
        return $this->robots;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Seo
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set changefreq
     *
     * @param string $changefreq
     * @return Seo
     */
    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;

        return $this;
    }

    /**
     * Get changefreq
     *
     * @return string 
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Seo
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @return array
     */
    static public function getRobotsChoices()
    {
        return self::$robotsChoice;
    }

    /**
     * @return array
     */
    static public function getChangefreqsChoices()
    {
        return self::$changefreqsChoice;
    }

}



