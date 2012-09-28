<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  
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
  
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return LandmarkDetail
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return LandmarkDetail
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set landmark
     *
     * @param Landmarx\LandmarkBundle\Entity\Landmark $landmark
     * @return LandmarkDetail
     */
    public function setLandmark(\Landmarx\LandmarkBundle\Entity\Landmark $landmark = null)
    {
        $this->landmark = $landmark;
        return $this;
    }

    /**
     * Get landmark
     *
     * @return Landmarx\LandmarkBundle\Entity\Landmark 
     */
    public function getLandmark()
    {
        return $this->landmark;
    }

    /**
     * Set detail_option
     *
     * @param Landmarx\LandmarkBundle\Entity\DetailOption $detailOption
     * @return LandmarkDetail
     */
    public function setDetailOption(\Landmarx\LandmarkBundle\Entity\DetailOption $detailOption = null)
    {
        $this->detail_option = $detailOption;
        return $this;
    }

    /**
     * Get detail_option
     *
     * @return Landmarx\LandmarkBundle\Entity\DetailOption 
     */
    public function getDetailOption()
    {
        return $this->detail_option;
    }

    /**
     * Set option_value
     *
     * @param Landmarx\LandmarkBundle\Entity\OptionValue $optionValue
     * @return LandmarkDetail
     */
    public function setOptionValue(\Landmarx\LandmarkBundle\Entity\OptionValue $optionValue = null)
    {
        $this->option_value = $optionValue;
        return $this;
    }

    /**
     * Get option_value
     *
     * @return Landmarx\LandmarkBundle\Entity\OptionValue 
     */
    public function getOptionValue()
    {
        return $this->option_value;
    }
}