<?php
namespace WH\CmsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use APP\CmsBundle\Entity\Menu;

class LoadMenu implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $listMenus = array(
	        array(
		        'name'  =>  'Menu header',
	            'slug'  =>  'menuHeader'
	        ),
	        array(
		        'name'  =>  'Menu footer',
		        'slug'  =>  'menuFooter'
	        )
        );

        foreach ($listMenus as $listMenu) {

            $menu = new Menu();

	        $menu->setName($listMenu['name']);
	        $menu->setSlug($listMenu['slug']);

            $manager->persist($menu);

        }

        $manager->flush();

    }

}
