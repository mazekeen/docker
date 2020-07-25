<?php

namespace App\Entity;

use App\Entity\Notification;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LikeNotificationRepository::class)
 */
class LikeNotification extends Notification
{
    /**
     * @ORM\ManyToOne(targetEntity=App\Entity\MicroPost::class)
    */
    private $microPost;

    /**
     * @ORM\ManyToOne(targetEntity=App\Entity\User::class)
    */
    private $likedBy;

    /**
     * @return mixed
     */
    public function getMicroPost()
    {
        return $this->microPost;
    }

    /**
     * @param mixed $microPost
    */
    public function setMicroPost($microPost) : void
    {
        $this->microPost = $microPost;
    }

    /**
     * @return mixed
     */
    public function getLikedBy()
    {
        return $this->likedBy;
    }

    /**
     * @param mixed $likedBy
    */
    public function setLikedBy($likedBy) : void
    {
        $this->likedBy = $likedBy;
    }


}
