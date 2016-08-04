<?php

namespace WH\CmsBundle\Menu;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Menu\FactoryInterface;

/**
 * Class Builder
 *
 * @package WH\CmsBundle\Menu
 */
class Builder extends Controller
{

	/**
	 * Menu header
	 *
	 * @param FactoryInterface $factory
	 * @param array            $options
	 *
	 * @return \Knp\Menu\ItemInterface
	 */
	public function treePages(FactoryInterface $factory, array $options = array())
	{

		$em = $this->getDoctrine()->getManager();

		$pageRepository = $em->getRepository('APPCmsBundle:Page');

		$menu = $factory->createItem(
			'root'
		);

		$pages = $pageRepository->get(
			'all',
			array(),
			true
		);

		foreach ($pages as $page) {

			if ($page->getLvl() == 0) {

				$menu->addChild(
					$page->getSlug(),
					array(
						'route'           => 'wh_front_cms_page',
						'routeParameters' => array('url' => $page->getUrl()),
						'label'           => $page->getName(),
						'class'           => 'dropdown',
						'attributes'      => array(
							'name'         => $page->getName(),
							'urlPublish'   => $this->generateUrl(
								'wh_admin_cms_page_publish',
								array(
									'page' => $page->getId(),
								)
							),
							'iconePublish' => ($page->getStatus() == 'published') ? 'fa-thumbs-o-up' : 'fa-thumbs-o-down',
							'classPublish' => ($page->getStatus() == 'published') ? 'btn-success' : 'btn-danger',
							'urlUpdate'    => $this->generateUrl(
								'wh_admin_cms_page_update',
								array(
									'page' => $page->getId(),
								)
							),
							'urlIndex'     => $this->generateUrl(
								'wh_admin_cms_pages',
								array(
									'parentPageId' => $page->getId(),
								)
							),
							'urlView'      => $this->generateUrl(
								'wh_front_cms_page',
								array(
									'url' => $page->getUrl(),
								)
							),
						),
					)
				);

				if (count($page->getChildren()) > 0) {

					$this->childrenTreePages($menu, $page->getSlug(), $page->getChildren());
				}
			}
		}

		return $menu;
	}

	/**
	 * Sous menu header
	 *
	 * @param $node
	 * @param $slug
	 * @param $sousPages
	 *
	 * @return mixed
	 */
	private function childrenTreePages($node, $slug, $sousPages)
	{

		foreach ($sousPages as $sousPage) {

			$node[$slug]->addChild(
				$sousPage->getSlug(),
				array(
					'route'           => 'wh_front_cms_page',
					'routeParameters' => array('url' => $sousPage->getUrl()),
					'label'           => $sousPage->getName(),
					'attributes'      => array(
						'name'         => $sousPage->getName(),
						'urlPublish'   => $this->generateUrl(
							'wh_admin_cms_page_publish',
							array(
								'page' => $sousPage->getId(),
							)
						),
						'iconePublish' => ($sousPage->getStatus(
							) == 'published') ? 'fa-thumbs-o-up' : 'fa-thumbs-o-down',
						'classPublish' => ($sousPage->getStatus() == 'published') ? 'btn-success' : 'btn-danger',
						'urlUpdate'    => $this->generateUrl(
							'wh_admin_cms_page_update',
							array(
								'page' => $sousPage->getId(),
							)
						),
						'urlIndex'     => $this->generateUrl(
							'wh_admin_cms_pages',
							array(
								'parentPageId' => $sousPage->getId(),
							)
						),
						'urlView'      => $this->generateUrl(
							'wh_front_cms_page',
							array(
								'url' => $sousPage->getUrl(),
							)
						),
					),
				)
			);

			if (count($sousPage->getChildren()) > 0) {

				$this->childrenTreePages($node[$slug], $sousPage->getSlug(), $sousPage->getChildren());
			}
		}

		return $node;
	}

}
