<?php
  namespace Landmarx\LandmarkCollectionBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  use Doctrine\Common\Collections\ArrayCollection;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkCollectionBundle\Repository\CollectionItemRepository")
   * @ORM\Table(name="collection_item")
   */
  class CollectionItem {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark $landmark
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkCollectionBundle\Entity\LandmarkCollection", inversedBy="collection_item")
     * @ORM\JoinColumn(name="collection_id", referencedColumnName="id")
     */
    protected $collection;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark $landmark
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\Landmark", inversedBy="landmark_detail")
     * @ORM\JoinColumn(name="landmark_id", referencedColumnName="id")
     */
    protected $landmark;
    
    /**
     *
     * @var integer $sort_num;
     * 
     * @ORM\Column(type="integer", name="sort_num") 
     */
    protected $sort_num;
    
  }