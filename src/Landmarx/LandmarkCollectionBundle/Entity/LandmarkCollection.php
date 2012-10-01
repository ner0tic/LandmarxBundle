<?php
  namespace Landmarx\LandmarkCollectionBundle\Entity;
  
  use Doctrine\ORM\Mapping as ORM;
  use Gedmo\Mapping\Annotation as Gedmo;
  use Doctrine\Common\Collections\ArrayCollection;
  
  /**
   * @ORM\Entity(repositoryClass="Landmarx\LandmarkCollectionBundle\Repository\LandmarkCollectionRepository")
   * @ORM\Table(name="landmark_collection")
   */
  class LandmarkCollection {
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
     * @var Landmarx\UserBundle\Entity\User 
     * 
     * @ORM\ManyToOne(targetEntity="Landmarx\UserBundle\Entity\User", inversedBy="landmark_collection")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * Toggle the collections visibility to the public
     * @var boolean $visibility 
     * 
     * @ORM\Column(type="boolean", name="public")
     */
    protected $public = true;
    
    /**
     * @var array $items
     * 
      @ORM\OneToMany(targetEntity="Landmark", mappedBy="landmark_collection")
     */
    protected $items = array();
    
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
    
    public function __construct() { $this->items = new ArrayCollection(); }    
  }