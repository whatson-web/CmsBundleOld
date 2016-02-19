<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\CmsBundle\Entity\Template;
use WH\CmsBundle\Form\TemplateType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/admin/cms/template")
 * Class TemplateController
 * @package WH\CmsBundle\Controller
 */
class TemplateController extends Controller
{

    /**
     * @Route("/", name="wh_admin_cms_templates")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('APPCmsBundle:Template')->findAll();


        return $this->render(
            'WHCmsBundle:Backend:Template/index.html.twig',
            array(
                'entities' => $entities
            )
        );

    }

    /**
     * @Route("/create", name="wh_admin_cms_template_create")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $entity = new Template();

        $form = $this->createForm(new TemplateType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Template ajouté');

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $this->generateUrl('wh_admin_cms_templates')
                )
            );

            return $response;

        }

        return $this->render(
            'WHCmsBundle:Backend:Template/create.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }



    /**
     * @Route("/update/{Template}", name="wh_admin_cms_template_update")
     * @param $Template
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @ParamConverter("Template", class="APPCmsBundle:Template")
     */
    public function updateAction($Template, Request $request)
    {

        $form = $this->createForm(new TemplateType(), $Template);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Template);

            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Opération réussie');

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $this->generateUrl('wh_admin_cms_templates')
                )
            );

            return $response;

        }

        return $this->render(
            'WHCmsBundle:Backend:Template/update.html.twig',
            array(
                'form' => $form->createView(),
                'Template' => $Template
            )
        );

    }

    /**
     * @Route("/delete/{Template}", name="wh_admin_cms_template_delete")
     * @param $Template
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @ParamConverter("Template", class="APPCmsBundle:Template")
     */
    public function deleteAction($Template, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $em->remove($Template);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Opération réussie');

        return $this->redirect($request->headers->get('referer'));


    }

}
