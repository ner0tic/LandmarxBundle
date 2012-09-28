<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  use Doctrine\Common\Collections\ArrayCollection;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\LandmarkCategoryRepository")
   * @ORM\Table(name="landmark_category")
   */
  class LandmarkCategory {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $name
     * 
     * @ORM\Column(type="string", name="name", length=250)
     */
    protected $name;
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark 
     * 
     * @ORM\ManyToOne(targetEntity="landmark", inversedBy="landmark")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent = null;
    
    /**
     * @var array $landmarks
     * 
     * @ORM\OneToMany(targetEntity="Landmark", mappedBy="landmark_category")
     */    
    protected $landmarks;
  
    /**
     * @var string $description
     * 
     * ORM\Column(type="text", name="name")
     */
    protected $description;
    
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
     * @var string $slug
     * 
     * @Gedmo\Slug(fields={"name"}) 
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;  
    
    public function __construct() { $this->landmarks = new ArrayCollection(); }
  
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() { return $this->id; }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() { return $this->name; }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Category
     */
    public function setCreated($created) {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated() { return $this->created; }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return Category
     */
    public function setUpdated($updated) {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated() { return $this->updated; }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() { return $this->slug; }

    /**
     * Set parent
     *
     * @param Landmarx\LandmarkBundle\Entity\Landmark $parent
     * @return Category
     */
    public function setParent(\Landmarx\LandmarkBundle\Entity\Landmark $parent = null) {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Landmarx\LandmarkBundle\Entity\Landmark
     */
    public function getParent() { return $this->parent; }

    /**
     * Add landmarks
     *
     * @param Landmarx\LandmarkBundle\Entity\Landmark $landmarks
     * @return Category
     */
    public function addLandmark(\Landmarx\LandmarkBundle\Entity\Landmark $landmarks) {
        $this->landmarks[] = $landmarks;
        return $this;
    }

    /**
     * Remove landmarks
     *
     * @param Landmarx\LandmarkBundle\Entity\Landmark $landmarks
     */
    public function removeLandmark(\Landmarx\LandmarkBundle\Entity\Landmark $landmarks) { $this->landmarks->removeElement($landmarks); }

    /**
     * Get landmarks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLandmarks(){ return $this->landmarks; }
}