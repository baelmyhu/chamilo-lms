<?php

/* For licensing terms, see /license.txt */

namespace Chamilo\CourseBundle\Entity;

use Chamilo\CoreBundle\Entity\AbstractResource;
use Chamilo\CoreBundle\Entity\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="c_shortcut")
 * @ORM\Entity
 */
class CShortcut extends AbstractResource implements ResourceInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Chamilo\CoreBundle\Entity\ResourceNode"
     * )
     * @ORM\JoinColumn(name="shortcut_node_id", referencedColumnName="id")
     */
    protected $shortCutNode;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Resource identifier.
     */
    public function getResourceIdentifier(): int
    {
        return $this->id;
    }

    public function getResourceName(): string
    {
        return $this->getName();
    }

    public function getShortCutNode()
    {
        return $this->shortCutNode;
    }

    /**
     * @return CShortcut
     */
    public function setShortCutNode($shortCutNode)
    {
        $this->shortCutNode = $shortCutNode;

        return $this;
    }
}
