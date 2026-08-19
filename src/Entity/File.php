<?php

namespace App\Entity;

use App\Repository\FileRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Attribute as Vich;

#[ORM\Entity(repositoryClass: FileRepository::class)]
#[Vich\Uploadable]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Vich\UploadableField(mapping: 'fichier', fileNameProperty: 'name', size: 'size', originalName: 'original_name')]
    // Uploads are stored under public/fichier/exercice/ (see config/packages/vich_uploader.yaml),
    // i.e. directly in the web root. Without a strict mime type allow-list, any authenticated
    // user could upload a script and have it served back by the web server. Restrict to the
    // document/image types this feature is actually meant for.
    #[Assert\File(
        maxSize: '10M',
        mimeTypes: [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'image/webp',
        ],
        mimeTypesMessage: 'Merci de déposer un fichier PDF ou une image (JPEG, PNG, WebP) de 10 Mo maximum.',
    )]
    private ?SymfonyFile $file = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $original_name = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    #[ORM\Column]
    private ?int $size = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function setOriginalName(string $original_name): static
    {
        $this->original_name = $original_name;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getUpdateAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdateAt(DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setFile(SymfonyFile $file = null): static
    {
        $this->file = $file;

        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();

            $this->extension = $file->guessExtension();
        }

        return $this;
    }

    public function getFile(): ?SymfonyFile
    {
        return $this->file;
    }
}
