<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use WH\CmsBundle\Form\Backend\BlocType;
use WH\CmsBundle\Entity\Bloc;
use APP\CmsBundle\Entity\TemplateRepository;
use APP\CmsBundle\Entity\PageRepository;


class PageBlocController extends Controller
{


    public function createAction($template, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $Bloc = new Bloc();

        $form = $this->_returnForm($Bloc);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            $Bloc->setTemplate($template);
            $Bloc->setDatas(array(
                    'Template'      => $form->get('Template')->getData(),
                    'Parent'      => $form->get('Parent')->getData(),
                )
            );

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

        return $this->render('WHCmsBundle:Backend:PageBloc/create.html.twig', array(
                'form'     => $form->createView(),
                'template' => $template
            ));

    }


    public function updateAction($Bloc, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $form = $this->_returnForm($Bloc);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            $Bloc->setDatas(array(
                    'Template'      => $form->get('Template')->getData(),
                    'Parent'      => $form->get('Parent')->getData(),
                )
            );

            $em->persist($Bloc);
            $em->flush();


            return $this->redirect($this->generateUrl('wh_admin_cms_blocs'));


        }

        return $this->render('WHCmsBundle:Backend:PageBloc/update.html.twig', array(
                'form'     => $form->createView(),
                'Bloc'     => $Bloc
            ));

    }



    private function _returnForm($Bloc) {


        $form = $this->createForm(new BlocType(), $Bloc);
        $em = $this->getDoctrine()->getManager();

        $datas = $Bloc->getDatas();

        $form
            ->add('Parent', 'entity', array(
                    'required' => false,
                    'mapped' => false,
                    'label' => 'Page parente',
                    'class' => 'APPCmsBundle:Page',
                    'empty_value' => 'Pas de page parente',
                    'property' => 'indentedName',
                    'data'          => (!empty($datas['Parent'])) ? $em->getReference("APPCmsBundle:Template", $datas['Parent']->getId()) : null,
                    'query_builder' => function(PageRepository $er) {

                            return $er->getChildrenQueryBuilder(null, null, 'root', 'asc', false);

                        }
                ))



            ->add(
                'Template', 'entity',
                array(
                    'label'         => 'Type de page : ',
                    'mapped'        => false,
                    'class'         => 'APPCmsBundle:Template',
                    'property'      => 'name',
                    'query_builder' => function (TemplateRepository $er) {

                            return $er->get('query', array('conditions' => array('Template.type' => 'page')));
                        },
                    'required'      => false,
                    'data'          => (!empty($datas['Template'])) ? $em->getReference("APPCmsBundle:Template", $datas['Template']->getId()) : null

                )
            )

        ;

        return $form;


    }



}