<?php

namespace WH\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 *
 * @package WH\CmsBundle\Controller
 */
class PageController extends Controller
{

    /**
     * @param string $url
     * @Route("/{url}", name="wh_front_cms_page", requirements={"url" = ".*"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function viewAction($url, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $pageRepository = $em->getRepository('APPCmsBundle:Page');

	    $page = $pageRepository->get(
	    	'one',
		    array(
		    	'conditions' => array(
		    		'Page.url' => $url
			    )
		    )
	    );

        if (!$page) {

            throw $this->createNotFoundException('Cette page n’existe plus ou a été déplacée');
        }

        if ($page->getTemplate()->getController()) {

            $response = $this->forward(
                $page->getTemplate()->getController(),
                array(
                    'Page'    => $page,
                    'request' => $request,
                )
            );

            return $response;
        }

        $path = $pageRepository->getPath($page);

        $renderVars = array();
        $renderVars['Page'] = $page;
        $renderVars['path'] = $path;

        $templateView = $page->getTemplate()->getTplt();

        if ($this->get('templating')->exists($templateView)) {

            return $this->render($templateView, $renderVars);
        } else {

            return $this->render('WHCmsBundle:Page:index.html.twig', $renderVars);
        }
    }

}
