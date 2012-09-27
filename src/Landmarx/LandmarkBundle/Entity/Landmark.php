<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gemo\Mapping\Annotation as Gedmo;
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
     * @ORM\OneToMany(targetEntity="Category", mappedBy="landmark")
     */    
    protected $categories;
  
    /**
     * @var Landmarx\LandmarkBundle\Entity\Category $primary_category
     * 
     * @ORM\ManyToOne(targetEntity="category", inversedBy="landmark")
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
    
    public function __construct() {
      $this->categories = new ArrayCollection();
    }
  }

?>
