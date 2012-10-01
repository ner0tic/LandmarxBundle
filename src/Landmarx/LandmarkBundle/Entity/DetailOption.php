<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\DetailOptionRepository")
   * @ORM\Table(name="detail_option")
   */
  class DetailOption {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark $landmark
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\Landmark", inversedBy="detail_option")
     * @ORM\JoinColumn(name="landmark_id", referencedColumnName="id")
     */
    protected $landmark;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark $landmark
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\LandmarkCategory", inversedBy="detail_option")
     * @ORM\JoinColumn(name="landmark_category_id", referencedColumnName="id")
     */    
    protected $landmark_category;
    
    /**
     *
     * @var string $name
     * 
     * ORM\Column(type="string", length=150) 
     */
    protected $name;
  }
  