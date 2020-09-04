<?php

namespace Application\Entity\Repository;
use Application\Entity\Products;
use Application\Entity\Users;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\Paginator\Paginator;

class NativeQueryRepository extends RootRepository
{


    /**
     * @param null $user_id
     * @param $page
     * @param $perpage
     * @return Paginator
     */
    public function getUsers($user_id=null,$page,$perpage): Paginator
    {

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Users::class,'ur');
        $rsm->addFieldResult('ur','id','id');
        $rsm->addFieldResult('ur','name','name');

        $entityManager = $this->getEntityManager();
        $sqlNative="SELECT * FROM `users` ";

        if ($user_id!=null){
            $sqlNative.= " where id = :user_id  ORDER BY id";
            $query = $entityManager->createNativeQuery($sqlNative,$rsm);
            $query->setParameter(['user_id'=>$user_id]);

        }else{
            $sqlNative.=" ORDER BY id";
            $query = $entityManager->createNativeQuery($sqlNative,$rsm);
        }
        return $this->paginateSql($query,$page,$perpage);
    }

    /**
     * @param null $user_id
     * @param $page
     * @param $perpage
     * @return Paginator
     */
    public function getProducts($user_id=null,$page,$perpage): Paginator
    {

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Products::class,'pr');
        $rsm->addFieldResult('pr','id','id');
        $rsm->addFieldResult('pr','name','name');
        $rsm->addFieldResult('pr','price','price');
        $rsm->addFieldResult('pr','description','description');
        $entityManager = $this->getEntityManager();
        $sqlNative="SELECT
        products.id
        products.name,
        products.description,
        products.price,
        dt_created
        FROM
            `user_product`
        LEFT JOIN products ON user_product.product_id = products.id";

            if ($user_id!=null){
                $sqlNative.= " where user_id = :user_id  ORDER BY dt_created";
                $query = $entityManager->createNativeQuery($sqlNative,$rsm);
                $query->setParameter(['user_id'=>$user_id]);

            }else{
                $sqlNative.=" ORDER BY dt_created";
                $query = $entityManager->createNativeQuery($sqlNative,$rsm);
            }
        return $this->paginateSql($query,$page,$perpage);
    }


    /**
     * @param $page
     * @param $perpage
     * @return Paginator
     */
    public function getLastUserProducts($page,$perpage): Paginator
    {
        $entityManager = $this->getEntityManager();
        $sqlNative="SELECT
    users.id AS user_id,
    users.name AS user_name,
    products.id AS product_id,
    products.name AS product_name,
    user_product.dt_created AS dt_created
FROM
    user_product
JOIN(
    SELECT
        user_id,
        id AS last_product
    FROM
        user_product
    GROUP BY
        user_id
    DESC
) AS T
ON
    T.last_product = user_product.id
LEFT JOIN users ON users.id = user_product.user_id
LEFT JOIN products ON user_product.product_id = products.id
order  by  user_name";


        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('user_id','user_id');
        $rsm->addScalarResult('user_name','user_name');
        $rsm->addScalarResult('product_id','product_id');
        $rsm->addScalarResult('product_name','product_name');
        $rsm->addScalarResult('dt_created','dt_created');
        $query = $entityManager->createNativeQuery($sqlNative,$rsm);
        return $this->paginateSql($query,$page,$perpage);
    }
}