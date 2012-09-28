<?php
  namespace Landmarx\LandmarkBundle\Repository;

  use Doctrine\ORM\EntityRepository;

  class LandmarkDetailRepository extends EntityRepository {
    /**
     * 
     * @param \Landmarx\LandmarkBundle\Repository\LandmarkDetail $landmark
     * @return array
     * @throws \InvalidArgumentException
     */
    public function filterByLandmark($landmark) {
      if(!$landmark instanceof Landmarx\LandmarkBundle\Entity\LandmarkDetail) // object
        throw new \InvalidArgumentException('argument must be of type LandmarkDetail');
      $query = 'SELECT l FROM LandmarxLandmarkBundle:Landmark l where l.landmark_id = :id';      
      
      return $this->getEntityManager()->createQuery($query)->setParameter('id', $landmark->getId())->getResult();
    }
  }