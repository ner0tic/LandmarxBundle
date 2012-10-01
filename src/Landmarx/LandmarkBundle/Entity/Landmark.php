<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  use Doctrine\Common\Collections\ArrayCollection;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\LandmarkRepository")
   * @ORM\Table(name="landmark")
   */
  class Landmark {
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
     * @var string $description
     * 
     * ORM\Column(type="text", name="name")
     */
    protected $description;    
    
    /**
     * @var Landmarx\LandmarkBundle\Entity\Landmark 
     * 
     * @ORM\ManyToOne(targetEntity="landmark", inversedBy="landmark")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent = null;
    
    /**
     * @var array $categories
     * 
     * @ORM\OneToMany(targetEntity="LandmarkCategory", mappedBy="landmark")
     */    
    protected $categories;
  
    /**
     * @var Landmarx\LandmarkBundle\Entity\LandmarkCategory $primary_category
     * 
     * @ORM\ManyToOne(targetEntity="landmarkCategory", inversedBy="landmark")
     * @ORM\JoinColumn(name="primary_category_id", referencedColumnName="id")
     */
    protected $primary_category;
    
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
    
    public function __construct() { $this->categories = new ArrayCollection(); }
  
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
     * @return Landmark
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
     * @return Landmark
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
     * @return Landmark
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
     * @return Landmark
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
     * @param Landmarx\LandmarkBundle\Entity\Landmark$parent
     * @return Landmark
     */
    public function setParent(\Landmarx\LandmarkBundle\Entity\Landmark$parent = null) {
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
     * Add category
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkCategory $categories
     * @return Landmark
     */
    public function addCategory(\Landmarx\LandmarkBundle\Entity\LandmarkCategory $category) {
        $this->categories[] = $category;
        return $this;
    }

    /**
     * Remove category
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkCategory $categories
     */
    public function removeCategory(\Landmarx\LandmarkBundle\Entity\LandmarkCategory $category) { $this->categories->removeElement($category); }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategories() { return $this->categories; }

    /**
     * Set primary_category
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkCategory $primaryCategory
     * @return Landmark
     */
    public function setPrimaryCategory(\Landmarx\LandmarkBundle\Entity\LandmarkCategory $primaryCategory = null) {
        $this->primary_category = $primaryCategory;
        return $this;
    }

    /**
     * Get primary_category
     *
     * @return Landmarx\LandmarkBundle\Entity\LandmarkCategory
     */
    public function getPrimaryCategory() { return $this->primary_category; }
  }