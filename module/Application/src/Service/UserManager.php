<?php
namespace Application\Service;

use Application\Entity\UserProduct;
use Application\Entity\Users;
use Application\Entity\Products;
use Doctrine\ORM\EntityManager;


class UserManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * AddressManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param null $user_id
     * @return mixed
     */
    public function getUsers($user_id=null)
    {
        $users =  $this->entityManager->getRepository(Users::class);
        return  $user_id ==null ? $users->findAll(): $users->findOneBy(['id'=>$user_id]);
    }
    /**
     * @param null $user_id
     * @return array
     */
    public function getProducts($user_id): array
    {
       $userProduct =  $this->entityManager->getRepository(UserProduct::class);
       return  $userProduct->findBy(['user'=>$user_id]);
    }

}