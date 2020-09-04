<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;
use Application\Entity\Repository\NativeQueryRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Zend\Mvc\Controller\AbstractActionController;
use ZendTwig\View\TwigModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{

    /**
     * @var
     */
    private $entityManager;
    /**
     * @var NativeQueryRepository
     */
    private $nativeRepository;


    /**
     * IndexController constructor.
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        if ($this->nativeRepository==null){
            $this->nativeRepository = new NativeQueryRepository($this->entityManager,new ClassMetadata('Application\Entity\Users'));
        }
    }

    /**
     * @return \Zend\View\Model\ViewModel|TwigModel
     */
    public function indexAction()
    {  $page = (int)$this->params()->fromRoute('page', 1);

       $lasProducts= $this->nativeRepository->getLastUserProducts($page,3);

       $viewModel = new TwigModel(['lastProducts'=>$lasProducts,'pages'=>$lasProducts->getPages()]);
       return     $viewModel;
    }


}
