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
    
    public function newAction() {
      $landmark = new Landmark();
      $form = $this->createForm(new LandmarkType(), $landmark);
      return $this->render('LandmarxLandmarkBundle:Landmark:new.html.twig', array(
          'form' => $form->createView()));
    }

    public function showAction($slug) {
      $repo = $this->getDoctrine()->getRepository('LandmarxLandmarkBundle:Landmark');
      $query = $repo->createQueryBuilder('l')->where('l.slug = :slug')->setParameter('slug', $slug);
      $landmark = $query->getSingleResult();
      if($landmark)
        return $this->render('LandmarxLandmarkBundle:Landmark:show.html.twig', array('landmark' => $landmark));
      throw $this->createNotFoundException('No landmark found.');
    }

    public function createAction() {
      $landmark = new Landmark();
      $em = $this->getDoctrine()->getEntityManager();
      $em->persist($landmark);
      $em->flush();
      return forward('LandmarxLandmarkBundle:Landmark:show', array('slug', $landmark->getSlug()));
    }
}
