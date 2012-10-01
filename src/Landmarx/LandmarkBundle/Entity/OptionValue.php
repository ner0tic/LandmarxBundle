<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\OptionValueRepository")
   * @ORM\Table(name="option_value")
   */
  class OptionValue {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type=text)
     */
    protected $value;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\DetailOption $detail_option
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\DetailOption", inversedBy="option_value")
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     */    
    protected $option;    
  }