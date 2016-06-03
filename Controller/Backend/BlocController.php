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

use WH\CmsBundle\Entity\Bloc;
use WH\CmsBundle\Form\Backend\BlocType;

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
     * @Route("/create", name="wh_admin_cms_bloc_create")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function createAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $Bloc = new Bloc();

        $form = $this->createForm(new BlocType(), $Bloc);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($Bloc);
            $em->flush();

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $this->generateUrl('wh_admin_cms_blocs')
                )
            );

            return $response;


        }

        return $this->render('WHCmsBundle:Backend:Bloc/create.html.twig', array(
            'form'     => $form->createView()
        ));

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

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new BlocType(), $Bloc);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($Bloc);
            $em->flush();

            return $this->redirect($this->generateUrl('wh_admin_cms_blocs'));

        }

        return $this->render('WHCmsBundle:Backend:Bloc/update.html.twig', array(
            'Bloc' => $Bloc,
            'form' => $form->createView()
        ));

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
