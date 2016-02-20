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

                case 'order':
                    $qb->orderBy('page.created', $value);
                    break;


                case 'type':
                    $qb->andWhere('template.type = :type');
                    $qb->setParameter('type', $value);

                    break;

                case 'conditions':

                    foreach($value as $k => $v) {

                        if(empty($v)) continue;

                        switch($k) {

                            case 'Search' :

                                $qb->orWhere('Post.body LIKE :search');
                                $qb->orWhere('Post.name LIKE :search');
                                $qb->orWhere('Post.title LIKE :search');
                                $qb->setParameter('search', '%'.$v.'%');

                                break;


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

                $qb->getQuery();

                return $qb->getResult();

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
