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
        $repo = $this->getDoctrine()->getRepository('Landmarx')
      }
      
    }
}
