<?php
  namespace Landmarx\LandmarkBundle\Controller;

  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Landmarx\LandmarkBundle\Entity\LandmarkCategory;
  use Landmarx\LandmarkBundle\Form\Type\LandmarkCategoryType;
  use Pagerfanta\Pagerfanta;
  use Pagerfanta\Adapter\DoctrineORMAdapter;
  use Pagerfanta\Exception\NotValidCurrentPageException;

  class LandmarkCategoryController extends Controller {
    public function indexAction() {
      $user = $this->get('security.context')->getToken()->getUser();
      /**
       * @todo move from hardcoded to config var
       */
      $max_pp = 10; 
      $pg = $this->getRequest()->get('page', 1);

      $repo = $this->getDoctrine()->getRepository('LandmarxLandmarkBundle:LandmarkCategory');
      $query = $repo->createQueryBuilder('l')->orderBy('l.name', 'ASC');

      $pager = new Pagerfanta(new DoctrineORMAdapter($query));
      $pager->setMaxPerPage($max_pp);
      $pager->setCurrentPage($pg);
      
      return $this->render('LandmarxLandmarkBundle:LandmarkCategory:index.html.twig', array(
          'pager'     =>  $pager
      ));
    }
}
