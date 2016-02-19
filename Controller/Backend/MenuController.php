<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\CmsBundle\Entity\Menu;
use WH\CmsBundle\Form\MenuType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/admin/cms/menu")
 * Class MenuController
 * @package WH\CmsBundle\Controller
 */
class MenuController extends Controller
{

    /**
     * @Route("/", name="wh_admin_cms_menus")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('APPCmsBundle:Menu')->findAll();


        return $this->render(
            'WHCmsBundle:Backend:Menu/index.html.twig',
            array(
                'entities' => $entities
            )
        );

    }

    /**
     * @Route("/create", name="wh_admin_cms_menu_create")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $entity = new Menu();

        $form = $this->createForm(new MenuType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Opération réussie');

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $this->generateUrl('wh_admin_cms_menus')
                )
            );

            return $response;

        }

        return $this->render(
            'WHCmsBundle:Backend:Menu/create.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }



    /**
     * @Route("/update/{Menu}", name="wh_admin_cms_menu_update")
     * @param $Menu
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @ParamConverter("Menu", class="APPCmsBundle:Menu")
     */
    public function updateAction($Menu, Request $request)
    {

        $form = $this->createForm(new MenuType(), $Menu);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Menu);

            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Opération réussie');

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $this->generateUrl('wh_admin_cms_menus')
                )
            );

            return $response;

        }

        return $this->render(
            'WHCmsBundle:Backend:Menu/update.html.twig',
            array(
                'form' => $form->createView(),
                'Menu' => $Menu
            )
        );

    }

    /**
     * @Route("/delete/{Menu}", name="wh_admin_cms_menu_delete")
     * @param $Menu
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @ParamConverter("Menu", class="APPCmsBundle:Menu")
     */
    public function deleteAction($Menu, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $em->remove($Menu);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Opération réussie');

        return $this->redirect($request->headers->get('referer'));


    }

}
