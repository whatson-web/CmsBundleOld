<?php

namespace WH\CmsBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections;

use APP\CmsBundle\Entity\Page;
use APP\OrganisationBundle\Entity\Organisation;
use WH\CmsBundle\Form\Backend\ContactType;


class ContactController extends Controller
{


	/**
     * @param         $page
     * @param Request $request
     * @ParamConverter("page", class="APPCmsBundle:Page")
	 * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function updatePageAction($page, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        /*
         * Retrouver l'organisation correpondante :
         */
        $organisation = $em->getRepository('APPOrganisationBundle:Organisation')->findOneByPage($page);

        if(!$organisation) {

            $organisation = new Organisation();

            $organisation->setPage($page);
            $organisation->setOrganisationType('prof');

            $em->persist($organisation);
            $em->flush();
            $em->refresh($organisation);

        }


        $WHCmsBundlePage = $em->getRepository('APPCmsBundle:Page');

        $form = $this->createForm(new ContactType(), $organisation);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($organisation);
            $em->flush();


            if($organisation->getDefault()) {

                $orgs = $em->getRepository('APPOrganisationBundle:Organisation')->findByDefault(true);

                foreach($orgs as $v) {
                    if($v->getId() != $organisation->getId()) {

                        $v->setDefault(false);
                        $em->persist($v);

                    }
                }

                $em->flush();

            }

            // Mise à jour des url
            $application = new Application($this->get('kernel'));
            $application->setAutoExit(false);
            $input = new ArrayInput(array('command' => 'wh:page:generateUrl', 'id' => $page->getId()));
            $application->run($input, new NullOutput());

            $request->getSession()->getFlashBag()->add('success', 'Page modifiée');



            if ($form->getClickedButton()->getName() == 'clickedButton') {

	            return $this->redirect($this->generateUrl('whad_cms_page_update', array('page' => $page->getId())));
            }

            return $this->redirect($this->generateUrl('wh_admin_cms_pages'));

        }

        $path = $WHCmsBundlePage->getPath($page);

        return $this->render('WHCmsBundle:Backend:Contact/update.html.twig', array(
			'page' => $organisation,
			'form' => $form->createView(),
			'path' => $path
        ));

    }


}
