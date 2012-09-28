<?php
  namespace Landmarx\LandmarkBundle\Repository;

  use Doctrine\ORM\EntityRepository;

  class LandmarkCategoryRepository extends EntityRepository {
    /**
     * 
     * @param \Landmarx\LandmarkBundle\Repository\LandmarkCategory $landmark
     * @return array
     * @throws \InvalidArgumentException
     */
    public function filterByLandmark($landmark) {
      if(!$landmark instanceof Landmarx\LandmarkBundle\Entity\LandmarkCategory) // object
        throw new \InvalidArgumentException('argument must be of type LandmarkCategory');
      $query = 'SELECT l FROM LandmarxLandmarkBundle:Landmark l where l.landmark_id = :id';      
      
      return $this->getEntityManager()->createQuery($query)->setParameter('id', $landmark->getId())->getResult();
    }
  }