<?php

namespace WH\CmsBundle\Model;

use Doctrine\ORM\EntityRepository;


class TemplateRepository extends EntityRepository
{


    public function getQuery()
    {

        return $this
            ->createQueryBuilder('Template')
            ;

    }


    /**
     * @param string $type
     * @param array $options
     * @param bool $admin
     * @return bool|\Doctrine\ORM\Query|Paginator
     */
    public function get($type = 'all', $options = array(), $admin = false)
    {

        $qb = $this->getQuery();

        foreach ($options as $key => $value) {

            switch ($key) {

                case 'limit':
                    $qb->setMaxResults($value);
                    break;

                case 'conditions':

                    foreach($value as $k => $v) {

                        if(empty($v)) continue;

                        switch($k) {

                            default :

                                $cond = preg_replace('#\.#', '', $k);
                                $cond = strtolower($cond);


                                $qb->andWhere($k. ' = :'.$cond);
                                $qb->setParameter($cond, $v);

                                break;


                        }



                    }

                break;

            }

        }

        switch ($type) {

            case 'query':

                return $qb;

                break;

            case 'all':

                return $qb->getQuery()->getResult();

                break;

            case 'one':

                $qb->getQuery();

                return $qb->getOneOrNullResult();

                break;

            case 'paginate':


                $qb->getQuery();

                if (!empty($typeOptions['page'])) {

                    $qb->setFirstResult(($typeOptions['page'] - 1) * $typeOptions['limit']);
                }

                if (!empty($typeOptions['limit'])) {

                    $qb->setMaxResults($typeOptions['limit']);
                }

                return new Paginator($qb, true);

                break;

        }

        return false;

    }





}
