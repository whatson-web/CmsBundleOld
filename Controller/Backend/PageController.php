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
 * @Route("/admin/cms/page")
 */
class PageController extends Controller
{

    /**
     * @Route("/{parentPageId}", name="wh_admin_cms_pages", requirements={"parentPageId" = "\d+"})
     * @param $parentPageId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($parentPageId = 0)
    {

        $em = $this->getDoctrine()->getManager();


        $APPCmsBundlePage = $em->getRepository('APPCmsBundle:Page');

        $APPCmsBundleTemplate = $em->getRepository('APPCmsBundle:Template');

        $parentPage = false;
        $path = '';
        $children = array();

        if ($parentPageId) {

            $parentPage = $APPCmsBundlePage->findOneById($parentPageId);

            $children = $APPCmsBundlePage->children($parentPage, true);

            $tmpPath = $APPCmsBundlePage->getPath($parentPage);

            foreach ($tmpPath as $v) {

                $path .= '<a href="' . $this->generateUrl(
                        'wh_admin_cms_pages',
                        array('parentPageId' => $v->getId())
                    ) . '" style="color:#FFF;">' . $v->getName() . '</a> / ';
            }

        //Cherche l'accueil et les autres pages enfantes
        }else{

            $children = array();

            $home = $APPCmsBundlePage->findOneByTemplate('home', true);

            if($home) {

                $children[] = $home;

                $children = $children + $APPCmsBundlePage->getChildren();

            }

        }


        $templates = $APPCmsBundleTemplate->findByType('page');

        return $this->render(
            'WHCmsBundle:Backend:Page/index.html.twig',
            array(
                'parentPage'    => $parentPage,
                'children'      => $children,
                'path'          => $path,
                'templates'     => $templates
            )
        );

    }

    /**
     * @Route("/create/{template}", name="wh_admin_cms_page_create")
     * @param $template
     * @param Request $request
     * @ParamConverter("template", class="APPCmsBundle:Template")
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function createAction($template, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $page = new Page();

        $form = $this->createForm(new PageType(), $page);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $page->setTemplate($template);

            $em->persist($page);
            $em->flush();

            // Mise à jour des url
            $application = new Application($this->get('kernel'));
            $application->setAutoExit(false);
            $input = new ArrayInput(array('command' => 'wh:page:generateUrl', 'id' => $page->getId()));
            $application->run($input, new NullOutput());

            $request->getSession()->getFlashBag()->add('success', 'Page créée');

            $response = new JsonResponse();

            if ($form->get('editer')->isClicked()) {

                $url = $this->generateUrl('wh_admin_cms_page_update', array('page' => $page->getId()));
            }else{

                $url = $this->generateUrl('wh_admin_cms_pages');
            }

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $url
                )
            );

            return $response;


        }

        return $this->render(
            'WHCmsBundle:Backend:Page/create.html.twig',
            array(
                'form'      => $form->createView(),
                'template'  => $template
            )
        );

    }

    /**
     * @Route("/update/{page}", name="wh_admin_cms_page_update")
     * @param $page
     * @ParamConverter("page", class="APPCmsBundle:Page")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($page, Request $request)
    {

        dump($page);
        if ($page->getTemplate()->getAdminController()) {

            return $this->forward(
                $page->getTemplate()->getAdminController() . ':updatePage',
                array(
                    'page' => $page,
                    'request' => $request
                )
            );
        }

        $em = $this->getDoctrine()->getManager();

        $APPCmsBundlePage = $em->getRepository('APPCmsBundle:Page');

        $form = $this->createForm(new PageUpdateType(), $page);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($page);
            $em->flush();

            // Mise à jour des url
            $application = new Application($this->get('kernel'));
            $application->setAutoExit(false);
            $input = new ArrayInput(array('command' => 'wh:page:generateUrl', 'id' => $page->getId()));
            $application->run($input, new NullOutput());

            $request->getSession()->getFlashBag()->add('success', 'Page modifiée');

            if ($form->get('save_and_stay')->isClicked()) {

                return $this->redirect($this->generateUrl('wh_admin_cms_page_update', array('page' => $page->getId())));
            }

            return $this->redirect($this->generateUrl('wh_admin_cms_pages'));

        }

        $path = $APPCmsBundlePage->getPath($page);

        return $this->render(
            'WHCmsBundle:Backend:Page/update.html.twig',
            array(
                'page' => $page,
                'form' => $form->createView(),
                'path' => $path
            )
        );

    }

    /**
     * @Route("/delete/{page}", name="wh_admin_cms_page_delete")
     * @param $page
     * @ParamConverter("page", class="APPCmsBundle:Page")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($page, Request $request)
    {

        if ($page->getTemplate() && $page->getTemplate()->getAdminController()) {

            return $this->forward(
                $page->getTemplate()->getAdminController() . ':adminDelete',
                array(
                    'page' => $page,
                    'request' => $request
                )
            );
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($page);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Page supprimée');

        return $this->redirect($request->headers->get('referer'));

    }

    /**
     * @Route("/publish/{page}", name="wh_admin_cms_page_publish")
     * @param $page
     * @ParamConverter("page", class="APPCmsBundle:Page")
     * @param Request $request
     * @return RedirectResponse
     */
    public function publishAction($page, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $status = 'published';
        $message = 'Page publiée';

        if ($page->getStatus() == 'published') {

            $status = 'draft';
            $message = 'Page dépubliée';
        }

        $page->setStatus($status);

        $em->persist($page);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', $message);

        return $this->redirect($request->headers->get('referer'));

    }

    /**
     * @Route("/order/{page}/{position}", name="wh_admin_cms_page_order")
     * @ParamConverter("page", class="APPCmsBundle:Page")
     * @return RedirectResponse
     *
     * @param         $page
     * @param         $position
     * @param Request $request
     */
    public function orderAction($page, $position, Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $APPCmsBundlePage = $em->getRepository('APPCmsBundle:Page');

        if ($position == 'up') {

            $APPCmsBundlePage->moveUp($page, 1);

        } else {

            $APPCmsBundlePage->moveDown($page, 1);

        }

        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Ordre modifié');

        return $this->redirect($request->headers->get('referer'));

    }

    /**
     * Retourne le code HTML du menu
     * @param Request $request
     * @Route("/menu-tree", name="wh_admin_cms_page_menu")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $repoPage = $em->getRepository('APPCmsBundle:Page');

        $controller = $this;

        $query = $repoPage->getMenuQuery();

        $options = array(
            'decorate' => true,
            'rootOpen' => '<ol class="dd-list">',
            'rootClose' => '</ol>',
            'childOpen' => '<li class="dd-item">',
            'childClose' => '</li>',
            'nodeDecorator' => function ($node) use (&$controller) {

                    $label = '';


                    if ($node['status'] == 'draft') {
                        $label = 'danger';
                        $icon = 'fa-thumbs-o-down';
                    } else {
                        $label = 'success';
                        $icon = 'fa-thumbs-o-up';
                    }

                    $return = '<div class="dd-handle">';

                    $return .= '<div class="pull-right">';
                    $return .= '<a href="' . $controller->generateUrl(
                            'wh_admin_cms_page_publish',
                            array('page' => $node['id'])
                        ) . '" class="btn btn-' . $label . ' btn-xs"><i class="fa ' . $icon . '"></i></a> ';
                    $return .= '<a href="' . $controller->generateUrl(
                            'wh_admin_cms_page_update',
                            array('page' => $node['id'])
                        ) . '" class="btn btn-primary btn-xs "><i class="fa fa-edit"></i></a> ';
                    $return .= '</div>';

                    $return .= '<a href="' . $controller->generateUrl(
                            'wh_admin_cms_pages',
                            array('parentPageId' => $node['id'])
                        ) . '">' . $node['name'] . '</a> ';
                    $return .= '<span>- ' . $node['template']['name'] . '</span>';
                    $return .= '<small><br /><a href="' . $controller->generateUrl(
                            'wh_admin_cms_page_publish',
                            array('page' => $node['id'])
                        ) . '">' . $node['url'] . '</a></small>';

                    $return .= '</div>';

                    return $return;

                }
        );

        $htmlTree = $repoPage->buildTree($query->getArrayResult(), $options);


        return $this->render(
            'WHCmsBundle:Backend:Page/menu.html.twig',
            array(
                'Pages' => $htmlTree
            )
        );

    }

    /**
     * @Route("/tree-recover", name="wh_admin_cms_page_treerecover")
     * @param Request $request
     * @return RedirectResponse
     */
    public function recoverAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('APPCmsBundle:Page');

        $repo->verify();
        $repo->recover();
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Arbre reconstruit');

        return $this->redirect($request->headers->get('referer'));

    }


}
