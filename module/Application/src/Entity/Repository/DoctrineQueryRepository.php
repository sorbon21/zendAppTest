<?php

namespace Application\Entity\Repository;
use Application\Entity\Products;
use Application\Entity\UserProduct;
use Application\Entity\Users;
use Zend\Paginator\Paginator;


/**
 * Class DoctrineQueryRepository
 * @package Application\Entity\Repository
 */
class DoctrineQueryRepository extends RootRepository
{

    /**
     * @return Paginator
     */
    public function getLastUserProducts($page=1,$perPage=10):Paginator
    {
        $entityManager = $this->getEntityManager();
        $subquery =  $entityManager->createQueryBuilder( );
        $subquery->select('max(up.id)')
            ->from(UserProduct::class,'up')->orderBy('up.id')->groupBy('up.user');
        $subqueryresult = $subquery->getQuery()->getArrayResult();
        $query =  $entityManager->createQueryBuilder();
        $query->select('up')->from(UserProduct::class,'up')->where('up.id IN (:ids)');
        $query->orderBy('up.user');
        $query->setParameter('ids',$subqueryresult);

        return  $this->paginate($query,$page,$perPage);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getOneProduct(int $id)
    {
        $entityManager = $this->getEntityManager();
        $query=$entityManager->createQueryBuilder();
        return $query->select('p')->from(Products::class, 'p')->where('p.id=:id')->setParameter('id',$id)->getQuery()->getArrayResult();
    }


    /**
     * @param null $user_id
     * @return array
     */
    public function getUser($user_id): array
    {
        $entityManager = $this->getEntityManager();
        $query=$entityManager->createQueryBuilder();
        $query->select('u')->from(Users::class, 'u');
        if (!is_null($user_id)) {
            return $query->where('u.id=:user_id')->setParameter('user_id',$user_id)->getQuery()->getArrayResult();
        }
        else
            return [];
    }



    /**
     * @param null $user_id
     * @return Paginator
     */
    public function getUsers($page=1,$perpage=3):Paginator
    {
        $entityManager = $this->getEntityManager();
        $query=$entityManager->createQueryBuilder();
        $query->select('u')->from(Users::class, 'u');
        return $this->paginate($query,$page,$perpage);
    }

    /**
     * @param  $user_id
     * @return Paginator
     */
    public function getProducts($user_id, $page=1 , $perpage=3): Paginator
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQueryBuilder();
        $query->select('u')->from(UserProduct::class, 'u');
        if (!is_null($user_id))
        {
            $query->where('u.user=:user_id')->setParameter('user_id',$user_id);
        }
        return $this->paginate($query,$page,$perpage);
    }

}