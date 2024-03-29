<?php
namespace WH\CmsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use APP\CmsBundle\Entity\Template;
use WH\CmsBundle\Entity\Bloc;

class LoadTemplate implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
        $listNames = array(
            'home'      => 'Accueil',
            'page'      => 'Page normale',
            'mentions'   => array(
                'type'              => 'page',
                'name'              => 'Page mentions légales',
                'tplt'              => ''
            ),

            'contact'   => array(
                'type'              => 'page',
                'name'              => 'Page contact',
                'adminController'   => 'WHCmsBundle:Backend/Contact',
                'controller'        => 'WHCmsBundle:Contact'
            ),
            'post'   => array(
                'type'              => 'post',
                'name'              => 'News'
            ),
            'work'   => array(
                'type'              => 'post',
                'name'              => 'réalisation'
            ),
            'bloc-blog'   => array(
                'type'              => 'bloc',
                'name'              => 'Bloc blog',
                'adminController'   => 'WHBlogBundle:Backend/Post',
                'controller'        => 'WHBlogBundle:Bloc:view',
                'blocs'             => array(
                    array(
                        'name'          => 'Liste d’actu',
                        'slug'          => 'list_news',
                        'view'          => 'WHBlogBundle:Post:listActus.html.twig'
                    )

                ),
            ),
            'bloc-medias'   => array(
                'type'              => 'bloc',
                'name'              => 'Bloc Medias',
                'adminController'   => 'WHCmsBundle:Backend/MediaBloc',
                'controller'        => 'WHCmsBundle:MediaBloc:view',
                'blocs'             => array(
                    array(
                        'name'          => 'Carrousel home',
                        'slug'          => 'carrousel-home',
                        'view'          => 'WHCmsBundle:MediaBloc:boostrap-carrousel.html.twig'
                    )

                ),
            ),
            'bloc-pages'   => array(
                'type'              => 'bloc',
                'name'              => 'Bloc Page',
                'adminController'   => 'WHCmsBundle:Backend/PageBloc',
                'controller'        => 'WHCmsBundle:PageBloc:view'
            ),

        );

        foreach ($listNames as $k => $name) {

            $Tpl = new Template();

            $Tpl->setType('page');
            $Tpl->setSlug($k);

            if(is_array($name)) {

                $Tpl->setName($name['name']);
                $Tpl->setSlug($k);

                if(!empty($name['controller'])) $Tpl->setController($name['controller']);
                if(!empty($name['adminController'])) $Tpl->setAdminController($name['adminController']);
                if(!empty($name['name'])) $Tpl->setTplt($name['name']);
                if(!empty($name['type'])) $Tpl->setType($name['type']);

            }else{

                $Tpl->setName($name);

            }



            // On le persiste
            $manager->persist($Tpl);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }
}