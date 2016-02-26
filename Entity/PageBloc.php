<?php

namespace WH\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use WH\CmsBundle\Model\PageBloc as BasePageBloc;

/**
 * PageBloc
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PageBloc extends BasePageBloc
{

    /**
     * @ORM\ManyToOne(targetEntity="APP\CmsBundle\Entity\Page", inversedBy="pageBlocs")
     */
    protected $page;


    /**
     * Set page
     *
     * @param \APP\CmsBundle\Entity\Page $page
     * @return PageBloc
     */
    public function setPage(\APP\CmsBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \APP\CmsBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }


}
