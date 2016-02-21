<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageBloc
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PageBloc
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    protected $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    protected $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\OneToOne(targetEntity="APP\CmsBundle\Entity\File", cascade={"persist", "remove"})
     */
    protected $thumb;

    /**
     * @ORM\ManyToOne(targetEntity="WH\CmsBundle\Entity\Bloc")
     */
    protected $bloc;

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
     * @return PageBloc
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
     * Set subtitle
     *
     * @param string $subtitle
     * @return PageBloc
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return PageBloc
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
     * Set position
     *
     * @param integer $position
     * @return PageBloc
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set thumb
     *
     * @param \APP\CmsBundle\Entity\File $thumb
     * @return PageBloc
     */
    public function setThumb(\APP\CmsBundle\Entity\File $thumb = null)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return \APP\CmsBundle\Entity\File
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set bloc
     *
     * @param \WH\CmsBundle\Entity\Bloc $bloc
     * @return PageBloc
     */
    public function setBloc(\WH\CmsBundle\Entity\Bloc $bloc = null)
    {
        $this->bloc = $bloc;

        return $this;
    }

    /**
     * Get bloc
     *
     * @return \WH\CmsBundle\Entity\Bloc
     */
    public function getBloc()
    {
        return $this->bloc;
    }

}
