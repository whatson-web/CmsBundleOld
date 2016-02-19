<?php
namespace WH\CmsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateUrlCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wh:page:generateUrl')
            ->setDescription('Génère les urls de l’entité page selon l’arborescence')
            ->addArgument('id', InputArgument::OPTIONAL, 'Id de la page parent')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        /*
         * Mettre à jour l'entité en question
         */
        $id = $input->getArgument('id');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $repo = $em->getRepository('APPCmsBundle:Page');

        $Page = $repo->findOneById($id);

        if(!$Page) return;

        $tplt = $Page->getTemplate();

        if($tplt && $tplt->getSlug() == 'home') {

            $Page->setUrl('');

        }else{

            //Création de l'url :
            $path = $repo->getPath($Page);

            $url = '';

            foreach($path as $v) {

                $tplt = ($v->getTemplate()) ? $v->getTemplate()->getSlug() : '' ;
                $slug = $v->getMySlug();

                $url .= ($tplt == 'home') ? '' : $slug.'/';

            }

            if($url != $Page->getUrl()) $Page->setUrl($url);

            $em->persist($Page);


            $output->writeln('<info>Création de ' . $url . '</info>');

            /*
             * Mettre à jour de tous les enfants de l‘entitté
             */
            $Children = $repo->children($Page);

            foreach($Children as $P) {

                $path = $repo->getPath($P);
                $url = '';

                foreach($path as $v) {

                    $tplt = ($v->getTemplate()) ? $v->getTemplate()->getSlug() : '' ;
                    $slug = $v->getMySlug();

                    $url .= ($tplt == 'home') ? '' : $slug.'/';

                }

                $P->setUrl($url);

                $em->persist($P);

                $output->writeln('<info>Création de ' . $url . '</info>');

            }

        }

        $em->flush();


    }
}