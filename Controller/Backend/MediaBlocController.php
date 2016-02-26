<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use WH\CmsBundle\Form\Backend\BlocType;
use WH\CmsBundle\Form\Backend\BlocMediaType;
use WH\CmsBundle\Entity\Bloc;
use APP\CmsBundle\Entity\TemplateRepository;


class MediaBlocController extends Controller
{


    /**
     * @param $template
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($template, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $Bloc = new Bloc();

        $form = $this->createForm(new BlocType(), $Bloc);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            $Bloc->setTemplate($template);

            $em->persist($Bloc);
            $em->flush();

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $this->generateUrl('wh_admin_cms_bloc_update', array('Bloc' => $Bloc->getId()))
                )
            );

            return $response;


        }

        return $this->render('WHCmsBundle:Backend:MediaBloc/create.html.twig', array(
                'form'     => $form->createView(),
                'template' => $template
            ));

    }

    /**
     * @param $Bloc
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($Bloc, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new BlocMediaType(), $Bloc);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            $em->persist($Bloc);
            $em->flush();

            return $this->redirect($this->generateUrl('wh_admin_cms_blocs'));


        }

        return $this->render('WHCmsBundle:Backend:MediaBloc/update.html.twig', array(
                'form'     => $form->createView(),
                'Bloc'     => $Bloc
            ));

    }


}