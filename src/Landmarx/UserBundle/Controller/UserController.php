<?php
  namespace Landmarx\UserBundle\Controller;

  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Pagerfanta\Pagerfanta;
  use Pagerfanta\Adapter\DoctrineORMAdapter;
  use Pagerfanta\Exception\NotValidCurrentPageException;

  class UserController extends Controller {
    
    public function indexAction() {
      $user = $this->get('security.context')->getToken()->getUser();
      /** @todo change from hardcode to config var **/
      $maxPerPg = 10;
      $page = $this->getRequest()->get('page',1);
      if($this->get('security.context')->isGranted('ROLE_USER')) {
        $repo = $this->getDoctrine()->getRepository('LandmarxLAndmarkBundle:Landmark');
        $query = $repo->createQueryBuilder('l')->OrderBy('l.createdAt', 'ASC');
        
        $pager = new PagerFanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($maxPerPg);
        $pager->setCurrentPage(1);
        $landmarks = $pager->getCurrentPageResults();
        
/* commented out until that bundle is complete        
        $repo = $this->getDoctrine()->getRepository('LandmarxLandmarkCollectionBundle:');
        $query = $repo->createQueryBuilder('l')->filterByUser($user)->OrderBy('l.createdAt', 'ASC');
        
        $pager = new PagerFanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($maxPerPg);
        $pager->setCurrentPage($this->getRequest('page',1));
        $collections = $pager->getCurrentPageResults();
*/        
        $collections = array();
        return $this->render('LandmarxUserBundle:User:dashboard.html.twig', array(
            'landmarks'   =>  $landmarks,
            'collections' =>  $collections
        ));
      }
      
    }
}
