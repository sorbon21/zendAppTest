<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Repository\DoctrineQueryRepository;
use Application\Entity\Repository\RootRepository;
use Application\Entity\Users;
use Doctrine\ORM\Mapping\ClassMetadata;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZendTwig\View\TwigModel;

/**
 * Class UserController
 * @package Application\Controller
 */
class UserController extends AbstractActionController
{

    /**
     * @var
     */
    private $entityManager;
    /**
     * @var
     */
    private $userManager;

    /**
     * @var
     */
    private $doctrineRepository;

    /**
     * UserController constructor.
     * @param $entityManager
     * @param $userManager
     */
    public function __construct($entityManager, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->userManager=$userManager;
        if ($this->doctrineRepository==null){
            $this->doctrineRepository=new DoctrineQueryRepository($this->entityManager,new ClassMetadata('Application\Entity\Users'));
        }
    }

    /**
     * @return ViewModel|TwigModel
     */
    public function indexAction()
    {
        $page = (int)$this->params()->fromRoute('page', 1);
        $users=$this->doctrineRepository->getUsers($page,3);

       // $users=$this->userManager->getUsers();
        $viewModel=new TwigModel(['users'=>$users,'pages'=>$users->getPages()]);
        $viewModel->setTemplate('user/index/index');

        return     $viewModel;
    }

    /**
     * @return TwigModel
     */
    public function productsAction()
    {
        $user_id = (int)$this->params()->fromRoute('id', 0);
        $page = (int)$this->params()->fromRoute('page', 1);
        $products=$this->doctrineRepository->getProducts($user_id,$page,3);

        //$products=$this->userManager->getProducts( $user_id);
        $user=$this->userManager->getUsers( $user_id);
        $viewModel=new TwigModel(['products'=>$products,'pages'=>$products->getPages(),'user'=>$user]);
        $viewModel->setTemplate('user/products/products');
        return     $viewModel;
    }

}
