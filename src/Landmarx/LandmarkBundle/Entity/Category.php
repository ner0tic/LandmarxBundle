<?php
  namespace Landmarx\LandmarkBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gemo\Mapping\Annotation as Gedmo;
  use Doctrine\Common\Collections\ArrayCollection;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\CategoryRepository")
   * @ORM\Table(name="category")
   */
  class Category {
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
     * @ORM\OneToMany(targetEntity="Landmark", mappedBy="category")
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
    
    public function __construct() {
      $this->landmarks = new ArrayCollection();
    }
  }

?>
