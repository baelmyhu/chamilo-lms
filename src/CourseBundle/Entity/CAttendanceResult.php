<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CourseBundle\Entity;

use Chamilo\CoreBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
<<<<<<< HEAD
=======
use Symfony\Component\Serializer\Attribute\Groups;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'c_attendance_result')]
#[ORM\Entity]
class CAttendanceResult
{
    #[ORM\Column(name: 'iid', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    protected ?int $iid = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
<<<<<<< HEAD
=======
    #[Groups(['attendance:read'])]
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    protected User $user;

    #[ORM\ManyToOne(targetEntity: CAttendance::class, inversedBy: 'results')]
    #[ORM\JoinColumn(name: 'attendance_id', referencedColumnName: 'iid', onDelete: 'CASCADE')]
    protected CAttendance $attendance;

    #[Assert\NotNull]
    #[ORM\Column(name: 'score', type: 'integer', nullable: false)]
    protected int $score;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAttendance(): CAttendance
    {
        return $this->attendance;
    }

    public function setAttendance(CAttendance $attendance): self
    {
        $this->attendance = $attendance;

        return $this;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
