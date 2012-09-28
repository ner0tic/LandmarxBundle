<?php
  namespace Landmarx\LandmarkBundle\Controller;

  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Landmarx\LandmarkBundle\Entity\Landmark;
  use Landmarx\LandmarkBundle\Form\Type\LandmarkType;
  use Pagerfanta\Pagerfanta;
  use Pagerfanta\Adapter\DoctrineORMAdapter;
  use Pagerfanta\Exception\NotValidCurrentPageException;

  class LandmarkController extends Controller {
    public function indexAction() {
      $user = $this->get('security.context')->getToken()->getUser();
      /**
       * @todo move from hardcoded to config var
       */
      $max_pp = 10; 
      $pg = $this->getRequest()->get('page', 1);

      $repo = $this->getDoctrine()->getRepository('LandmarxLandmarkBundle:Landmark');
      $query = $repo->createQueryBuilder('l')->orderBy('l.name', 'ASC');

      $pager = new Pagerfanta(new DoctrineORMAdapter($query));
      $pager->setMaxPerPage($max_pp);
      $pager->setCurrentPage($pg);
      
      return $this->render('LandmarxLandmarkBundle:Landmark:index.html.twig', array(
          'pager'     =>  $pager
      ));
    }
}
