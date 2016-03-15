<?php

namespace WH\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlocCollection
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BlocCollection
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
     * @ORM\OneToMany(targetEntity="APP\CmsBundle\Entity\File", mappedBy="blocCollection", cascade={"persist", "remove"})
     */
    private $files;

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
     * Constructor
     */
    public function __construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add files
     *
     * @param \APP\CmsBundle\Entity\File $files
     * @return BlocCollection
     */
    public function addFile(\APP\CmsBundle\Entity\File $files)
    {
        $this->files[] = $files;

        $files->setBlocCollection($this);

        return $this;
    }

    /**
     * Remove files
     *
     * @param \APP\CmsBundle\Entity\File $files
     */
    public function removeFile(\APP\CmsBundle\Entity\File $files)
    {
        $files->setBlocCollection(null);
        $this->files->removeElement($files);
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
}
