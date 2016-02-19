<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\EntityRepository;


class TemplateRepository extends EntityRepository
{

    public function findByType($type) {

        switch($type) {

            case 'bloc' :

                $qb = $this
                    ->createQueryBuilder('a')
                    ->select('a');

                $qb
                    ->add('where', $qb->expr()->in('a.Type', ':type'))
                    ->setParameter('type', array('bloc', 'collection'))
                ;

                break;

            default :

                $qb = $this
                    ->createQueryBuilder('a')
                    ->select('a')
                    ->andWhere('a.Type = :type')
                    ->setParameter('type', $type)
                ;

                break;

        }


        return $qb;

    }

}
