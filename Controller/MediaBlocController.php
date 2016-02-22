<?php

namespace WH\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MediaBlocController extends Controller
{

	public function viewAction($slug)
    {

        $em = $this->getDoctrine()->getManager();

        $Bloc = $em->getRepository('WHCmsBundle:Bloc')->findOneBySlug($slug);

        return $this->render($Bloc->getView(), array(
                'Bloc' => $Bloc
            ));

    }


}