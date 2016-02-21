<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections;
use Symfony\Component\HttpFoundation\JsonResponse;

use APP\CmsBundle\Entity\Page;
use WH\CmsBundle\Form\PageType;
use WH\CmsBundle\Form\PageUpdateType;

use WH\CmsBundle\Controller\Backend\PageController as WHPageCtrl;

/**
 * @Route("/admin/cms/bloc")
 */
class BlocController extends Controller
{

    /**
     * @Route("/", name="wh_admin_cms_blocs")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();


        $blocs = $em->getRepository('WHCmsBundle:Bloc')->findAll();
        $templates = $em->getRepository('APPCmsBundle:Template')->findByType('bloc');


        return $this->render(
            'WHCmsBundle:Backend:Bloc/index.html.twig',
            array(
                'templates'     => $templates,
                'Blocs'         => $blocs
            )
        );

    }

    /**
     * @Route("/create/{template}", name="wh_admin_cms_bloc_create")
     * @param $template
     * @param Request $request
     * @ParamConverter("template", class="APPCmsBundle:Template")
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function createAction($template, Request $request)
    {

        return $this->forward(
            $template->getAdminController() . ':create',
            array(
                'template' => $template,
                'request' => $request
            )
        );

    }


    /**
     * @Route("/update/{Bloc}", name="wh_admin_cms_bloc_update")
     * @param $Bloc
     * @param Request $request
     * @ParamConverter("Bloc", class="WHCmsBundle:Bloc")
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function updateAction($Bloc, Request $request)
    {

        return $this->forward(
            $Bloc->getTemplate()->getAdminController() . ':update',
            array(
                'Bloc' => $Bloc,
                'request' => $request
            )
        );

    }


    /**
     * @Route("/update/{Bloc}", name="wh_admin_cms_bloc_delete")
     * @param $Bloc
     * @param Request $request
     * @ParamConverter("Bloc", class="WHCmsBundle:Bloc")
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function deleteAction($Bloc, Request $request)
    {

       exit('test');

    }

}
