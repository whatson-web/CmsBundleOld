<?php

namespace WH\CmsBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class CompanyExtension extends \Twig_Extension
{

    private $container;

    private $field;

    private $Company = false;

    public function __construct(Container $container) {

        $this->container = $container;

        $em = $this->container->get('doctrine')->getManager();

        $repo = $em->getRepository('APPOrganisationBundle:Organisation');

        $this->Company = $repo->createQueryBuilder('Company')
            ->leftJoin('Company.page', 'page')
            ->select('Company')
            ->addSelect('page')
            ->andWhere('Company.default = true')
            ->getQuery()
            ->getScalarResult()
        ;

        if(count($this->Company)) $this->Company = $this->Company[0];

    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('Company', array($this, 'getValue'))
        );
    }

    public function getValue($field)
    {

        if(!$this->Company) return 'Compagny non connue ';

        if(isset($this->Company['Company_'.$field])) return $this->Company['Company_'.$field];
        if(isset($this->Company['page_'.$field])) return $this->Company['page_'.$field];

        return 'Champ non connue';

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Company';
    }

}
