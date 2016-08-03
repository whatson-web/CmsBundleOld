<?php

namespace WH\CmsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateUrlCommand
 *
 * @package WH\CmsBundle\Command
 */
class GenerateUrlCommand extends ContainerAwareCommand
{

	protected function configure()
	{

		$this
			->setName('wh:page:generateUrl')
			->setDescription('Génère les urls de l\'entité page selon l\'arborescence')
			->addArgument('id', InputArgument::OPTIONAL, 'Id de la page parent');
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return bool|void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{

		$container = $this->getContainer();

		/*
		 * Mettre à jour l'entité en question
		 */
		$id = $input->getArgument('id');

		$em = $container->get('doctrine')->getManager();

		$pageRepository = $em->getRepository('APPCmsBundle:Page');

		$page = $pageRepository->findOneById($id);

		if (!$page) {
			return false;
		}

		$tplt = $page->getTemplate();

		if ($tplt && $tplt->getSlug() == 'home') {

			$page->setUrl('');

		} else {

			// Création de l'url :
			$path = $pageRepository->getPath($page);

			$url = '';

			foreach ($path as $v) {

				$tplt = ($v->getTemplate()) ? $v->getTemplate()->getSlug() : '';
				$slug = $v->getMySlug();

				$url .= ($tplt == 'home') ? '' : $slug . '/';
			}

			if ($url != $page->getUrl()) {
				$page->setUrl($url);
			}

			$em->persist($page);

			$output->writeln('<info>Création de ' . $url . '</info>');

			/*
			 * Mettre à jour de tous les enfants de l‘entitté
			 */
			$children = $pageRepository->children($page);

			foreach ($children as $child) {

				$path = $pageRepository->getPath($child);
				$url = '';

				foreach ($path as $v) {

					$tplt = ($v->getTemplate()) ? $v->getTemplate()->getSlug() : '';
					$slug = $v->getMySlug();

					$url .= ($tplt == 'home') ? '' : $slug . '/';
				}

				$child->setUrl($url);

				$em->persist($child);

				$output->writeln('<info>Création de ' . $url . '</info>');
			}
		}

		$em->flush();

		return true;
	}
}