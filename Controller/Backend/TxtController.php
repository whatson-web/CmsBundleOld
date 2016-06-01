<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WH\CmsBundle\Entity\Txt;
use WH\CmsBundle\Form\Backend\TxtType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/admin/cms/txts")
 */
class TxtController extends Controller
{

    /**
     * @Route("/", name="wh_bk_cms_txts")
     * @return \Symfony\Component\HttpFoundation\Response$
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WHCmsBundle:Txt')->findAll();

        return $this->render(
            'WHCmsBundle:Backend:Txt/index.html.twig',
            array(
                'entities' => $entities
            )
        );

    }

    /**
     * CREATE
     *
     * @param Request $request
     * @Route("/create", name="wh_bk_cms_txt_create")
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {

        $entity = new Txt();

        $form = $this->createForm(new TxtType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Paramètre ajouté');

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid'     => true,
                    'redirect'  => $this->generateUrl('wh_bk_cms_txts')
                )
            );

            return $response;

        }

        return $this->render(
            'WHCmsBundle:Backend:Txt/create.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * UPDATE
     *
     * @param         $txt
     * @param Request $request
     * @ParamConverter("txt", class="WHCmsBundle:Txt")
     * @Route("/{txt}/update", name="wh_bk_cms_txt_update")
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($txt, Request $request)
    {

        $form = $this->createForm(new TxtType(), $txt);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($txt);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Paramètre modifié');

            $response = new JsonResponse();

            $response->setData(
                array(
                    'valid'     => true,
                    'redirect'  => $this->generateUrl('wh_bk_cms_txts')
                )
            );

            return $response;

        }

        return $this->render(
            'WHCmsBundle:Backend:Txt/update.html.twig',
            array(
                'txt' => $txt,
                'form' => $form->createView()
            )
        );

    }

    /**
     * DELETE
     *
     * @param         $txt
     * @param Request $request
     * @ParamConverter("txt", class="WHCmsBundle:Txt")
     * @Route("/{txt}/delete", name="wh_bk_cms_txt_delete")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($txt, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $em->remove($txt);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', 'Paramètre supprimé');

        return $this->redirect($request->headers->get('referer'));

    }

}
