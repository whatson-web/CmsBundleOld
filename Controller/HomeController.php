<?php

namespace WH\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/")
 */
class HomeController extends Controller
{

	/**
     * @Route("", name="wh_front_home")
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	public function viewAction()
    {

        $em = $this->getDoctrine()->getManager();

        $Page = $em->getRepository('APPCmsBundle:Page')->get('one', array('conditions' => array('Template.slug' => 'home')));


        return $this->render('WHCmsBundle:Home:index.html.twig', array(
                'Page' => $Page

            ));



    }





}