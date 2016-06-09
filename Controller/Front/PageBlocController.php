<?php

namespace WH\CmsBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use WH\CmsBundle\Form\Backend\BlocType;
use WH\CmsBundle\Entity\Bloc;
use APP\CmsBundle\Entity\TemplateRepository;


class PageBlocController extends Controller
{

    public function viewAction($slug)
    {

        $em = $this->getDoctrine()->getManager();

        $bloc = $em->getRepository('WHCmsBundle:Bloc')->findOneBySlug($slug);

        $datas = $bloc->getDatas();

        $datas = array(
            'conditions' => $datas

        );

        $Pages = $em->getRepository('APPCmsBundle:Page')->get('all', $datas);

        return $this->render($bloc->getView(), array(
                'Bloc' => $bloc,
                'Pages' => $Pages
            ));

    }


}