<?php

namespace Application\Entity\Repository;
use Application\Service\SqlPaginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Paginator\ScrollingStyle\Sliding;

class RootRepository extends EntityRepository
{

    /**
     * @param QueryBuilder $query
     * @param $perpage
     * @param $page
     * @return Paginator
     */
    public function paginate(QueryBuilder $query, $page=1, $perpage=3):Paginator
    {
        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        Paginator::setDefaultScrollingStyle(new Sliding());
        $paginator = new Paginator($adapter);
        $paginator::setDefaultItemCountPerPage($perpage);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }


    /**
     * @param QueryBuilder $query
     * @param $perpage
     * @param $page
     * @return Paginator
     */
    public function paginateSql($query, $page = 1, $perpage = 3): Paginator
    {
        $adapter = new SqlPaginator($query,$page);
        $paginator = new Paginator($adapter);
        $paginator::setDefaultItemCountPerPage($perpage);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }

}