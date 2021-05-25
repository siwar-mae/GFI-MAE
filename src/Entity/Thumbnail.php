<?php

namespace App\Entity;

use App\Behavior\Timestampable;
use App\Behavior\Uuidable;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Thumbnail.
 *
 * @ORM\Table(name="thumbnail")
 * @ORM\Entity(repositoryClass="App\Repository\ThumbnailRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Thumbnail
{
    use Uuidable;
    use Timestampable;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * One Customer has One Cart.
     *
     * @ORM\OneToOne(targetEntity="User", mappedBy="thumbnail", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @Vich\UploadableField(mapping="company_image", fileNameProperty="link")
     *
     * @var File
     * @Assert\File(
     *     maxSize="200k",
     *     mimeTypes={"image/png", "image/jpeg", "image/jpg"},
     *     mimeTypesMessage="Please upload a valid image , Max Size 200 KO , PNG,JPG,JPEG"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(name="target_link", type="string", nullable=true)
     */
    private $targetLink;

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName($link)
    {
        $this->link = $link;
    }

    public function getImageName()
    {
        return $this->link;
    }

    /**
     * @return $this
     *
     * @throws \Exception
     */
    public function setImageFile(File $imageName = null)
    {
        $this->imageFile = $imageName;
        if ($imageName) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Thumbnail
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set link.
     *
     * @param string $link
     *
     * @return Thumbnail
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set user.
     *
     * @return Thumbnail
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \App\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set targetLink.
     *
     * @param string|null $targetLink
     *
     * @return Thumbnail
     */
    public function setTargetLink($targetLink = null)
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    /**
     * Get targetLink.
     *
     * @return string|null
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }
}
