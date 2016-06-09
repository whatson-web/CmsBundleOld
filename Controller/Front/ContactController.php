<?php

namespace WH\CmsBundle\Controller\Front;

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
use WH\CmsBundle\Form\PageType;
use WH\CmsBundle\Form\PageUpdateType;
use WH\CmsBundle\Form\ContactUpdateType;



class ContactController extends Controller
{


    /**
     * Affiche les infos du foooter
     * @return mixed
     */
    public function footerAction() {

        $em = $this->getDoctrine()->getManager();

        $organisation = $em->getRepository('WHOrganisationBundle:Organisation')->findOneByDefault(true);

        if(!$organisation) exit();

        return $this->render('WHCmsBundle:Contact:public/footer.html.twig', array(
                'Organisation' => $organisation,
            ));

    }



}
