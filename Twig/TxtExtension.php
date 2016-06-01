<?php

namespace WH\CmsBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class TxtExtension extends \Twig_Extension
{

    private $container;

    private $parameters = array();

    public function __construct(Container $container) {

        $this->container = $container;

        $em = $this->container->get('doctrine')->getManager();
        $parameters = $em->getRepository('WHCmsBundle:Txt')->findAll();
        foreach ($parameters as $parameter) {

            $this->parameters[$parameter->getSlug()] = $parameter;
        }


    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getParameter', array($this, 'getParameter'))
        );
    }

    public function getParameter($slug)
    {

        $parameter = null;

        if (!empty($this->parameters[$slug])) {

            $parameter = $this->parameters[$slug];
        }

        if (!$parameter) {

            return 'Paramètre manquant : ' . $slug;
        }

        switch ($parameter->getType()) {

            case 'link':
                return array(
                    'link' => $parameter->getValueLink(),
                    'name' => $parameter->getValueString(),
                );
                break;

            case 'input':
                return $parameter->getValueString();
                break;

            case 'textarea':
                return $parameter->getValueText();
                break;

        }

        return 'Type de paramètre manquant : ' . $slug;

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parameter';
    }

}
