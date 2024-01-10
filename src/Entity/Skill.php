<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: course::class)]
    private Collection $course_id;

    public function __construct()
    {
        $this->course_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, course>
     */
    public function getCourseId(): Collection
    {
        return $this->course_id;
    }

    public function addCourseId(course $courseId): static
    {
        if (!$this->course_id->contains($courseId)) {
            $this->course_id->add($courseId);
        }

        return $this;
    }

    public function removeCourseId(course $courseId): static
    {
        $this->course_id->removeElement($courseId);

        return $this;
    }
}
