<?php
namespace WH\CmsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use APP\CmsBundle\Entity\Template;

class LoadTemplate implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
        $listNames = array(
            'page'      => 'Page normale',
            'rubrique'  => 'Rubrique de catalogue',
            'blog'      => 'Catégorie d’actu',
            'home'      => 'Accueil',
            'contact'   => array(
                'name'              => 'Page contact',
                'adminController'   => 'WHCmsBundle:Backend/Contact',
                'controller'        => 'WHCmsBundle:Contact'
            ),
            'mentions'  => 'Mentions légales',
        );

        foreach ($listNames as $k => $name) {
            // On crée l'utilisateur
            $Tpl = new Template;

            // Le nom d'utilisateur et le mot de passe sont identiques
            $Tpl->setName($name);
            $Tpl->setSlug($k);
	        $Tpl->setType('page');

            // On le persiste
            $manager->persist($Tpl);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }
}