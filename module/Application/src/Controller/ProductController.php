<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Repository\DoctrineQueryRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Zend\Mvc\Controller\AbstractActionController;
use ZendTwig\View\TwigModel;


class ProductController extends AbstractActionController
{

    private $entityManager;
    private $doctrineRepository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        if ($this->doctrineRepository==null){
            $this->doctrineRepository=new DoctrineQueryRepository($this->entityManager,new ClassMetadata('Application\Entity\Users'));
        }
    }

    public function productAction()
    {
        $id = (int)$this->params()->fromRoute('id', 1);
        $oneProduct=$this->doctrineRepository->getOneProduct($id);
        $viewModel=new TwigModel(['product'=>$oneProduct[0]]);
        $viewModel->setTemplate('product/product/product');
        return $viewModel;
    }


    public function latestProductsAction()
    {
        $page = (int)$this->params()->fromRoute('page', 1);
        $lastProducts = $this->doctrineRepository->getLastUserProducts($page,3);
        $viewModel=new TwigModel(['lastProducts'=>$lastProducts,'pages'=> $lastProducts->getPages()]);
        $viewModel->setTemplate('product/latestProducts/latestProducts');
        return $viewModel;
    }
}
