<?php

namespace App\Entity;

use App\Repository\ExerciceSkillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceSkillRepository::class)]
class ExerciceSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Skill $skill_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExerciseId(): ?Exercise
    {
        return $this->exercise_id;
    }

    public function setExerciseId(?Exercise $exercise_id): static
    {
        $this->exercise_id = $exercise_id;

        return $this;
    }

    public function getSkillId(): ?Skill
    {
        return $this->skill_id;
    }

    public function setSkillId(?Skill $skill_id): static
    {
        $this->skill_id = $skill_id;

        return $this;
    }
}
