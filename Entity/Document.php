<?php
/**
 * Created by : Vincent SAISSET
 * Date: 21/08/13
 * Time: 15:58
 */

namespace Innova\CollecticielBundle\Entity;

use Claroline\CoreBundle\Entity\Resource\ResourceNode;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Innova\CollecticielBundle\Repository\DocumentRepository")
 * @ORM\Table(name="innova_collecticielbundle_document")
 */
class Document {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $url;
    /**
     * @ORM\ManyToOne(
     *      targetEntity="Claroline\CoreBundle\Entity\Resource\ResourceNode"
     * )
     * @ORM\JoinColumn(name="resource_node_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $resourceNode;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Innova\CollecticielBundle\Entity\Comment",
     *     mappedBy="document",
     *     cascade={"all"},
     *     orphanRemoval=true
     * )
     */
    protected $comments;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $validate = false;


    /**
     * @ORM\ManyToOne(
     *     targetEntity="Innova\CollecticielBundle\Entity\Drop",
     *     inversedBy="documents",
     * )
     */
    protected $drop;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ResourceNode
     */
    public function getResourceNode()
    {
        return $this->resourceNode;
    }

    /**
     * @param ResourceNode $resourceNode
     */
    public function setResourceNode($resourceNode)
    {
        $this->resourceNode = $resourceNode;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param Drop $drop
     */
    public function setDrop($drop)
    {
        $this->drop = $drop;
    }

    /**
     * @return Drop
     */
    public function getDrop()
    {
        return $this->drop;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * @param mixed $reported
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        $json = array(
            'id' => $this->getId(),
            'type' => $this->getType(),
            'url' => $this->getUrl()
        );
        if ($this->getResourceNode() !== null) {
            $json['resourceNode'] = array(
                'id' => $this->getResourceNode()->getId(),
                'name' => $this->getResourceNode()->getName(),
            );
        }

        return $json;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \Innova\CollecticielBundle\Entity\Comment $comments
     * @return Document
     */
    public function addComment(\Innova\CollecticielBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Innova\CollecticielBundle\Entity\Comment $comments
     */
    public function removeComment(\Innova\CollecticielBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
