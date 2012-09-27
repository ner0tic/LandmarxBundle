<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gemo\Mapping\Annotation as Gedmo;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\LandmarkDetailRepository")
   * @ORM\Table(name="landmark_detail")
   */
  class LandmarkDetail {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark $landmark
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\Landmark", inversedBy="landmark_detail")
     * @ORM\JoinColumn(name="landmark_id", referencedColumnName="id")
     */
    protected $landmark;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\DetailOption $detail_option
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\DetailOption", inversedBy="landmark_detail")
     * @ORM\JoinColumn(name="detail_option_id", referencedColumnName="id")
     */
    protected $detail_option; 

    /**
     * @var Landmarx\LandmarkBundle\Entity\OptionValue $option_value
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\OptionValue", inversedBy="landmark_detail")
     * @ORM\JoinColumn(name="option_value_id", referencedColumnName="id")
     */
    protected $option_value;     
    
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;
  }

?>