<?php

namespace WH\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin/page")
 */
class PageController extends Controller
{

	/**
	 * @param string $url
     * @Route("/{url}", name="wh_front_cms_page")
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	public function viewAction($url = '')
    {

        $tab = array();

        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('WHCmsBundle:Page');

        $Page = $repo->findOneByUrl($url);

        if(!$Page) {

            //Là faudrait aller voir dans l'historique
            throw $this->createNotFoundException('Cette page n’existe plus ou a été déplacée');

        }

        $tab['Page'] = $Page;

        if ($Page->getTemplate()->getController()) {

            $response = $this->forward($Page->getTemplate()->getController(), array(
                'Page'  => $Page
            ));

            return $response;

        }

        //File d'ariane
        $path = $repo->getPath($Page);
        $tab['path'] = $path;

        //Template :
        $Tpl = $Page->getTemplate()->getSlug();

        if ( $this->get('templating')->exists('WHCmsBundle:Page:public/'.$Tpl.'.html.twig') ) {

            return $this->render('WHCmsBundle:Page:public/'.$Tpl.'.html.twig', $tab);

        }else{

            return $this->render('WHCmsBundle:Page:public/page.html.twig', $tab);

        }



    }





}