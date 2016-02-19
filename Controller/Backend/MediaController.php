<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/admin/cms/medias")
 * Class MenuController
 * @package WH\CmsBundle\Controller
 */
class MediaController extends Controller
{


    /**
     * @Route("/{type}", name="wh_admin_cms_medias", defaults={"type" = "default"})
     * @param $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($type)
    {

        return $this->render('WHCmsBundle:Backend:Media/index.html.twig', array(

            'type' => $type

        ));
    }
}
