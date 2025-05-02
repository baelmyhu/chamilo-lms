<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CourseBundle\Entity;

use Chamilo\CoreBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'c_attendance_sheet')]
#[ORM\Index(columns: ['presence'], name: 'presence')]
#[ORM\Entity]
class CAttendanceSheet
{
<<<<<<< HEAD
=======
    public const ABSENT = 0;
    public const PRESENT = 1;
    public const LATE_LESS_THAN_15_MINUTES = 2;
    public const LATE_MORE_THAN_15_MINUTES = 3;
    public const ABSENT_BUT_JUSTIFIED = 4;

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    #[ORM\Column(name: 'iid', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    protected ?int $iid = null;

<<<<<<< HEAD
    #[Assert\NotNull]
    #[ORM\Column(name: 'presence', type: 'boolean', nullable: false)]
    protected bool $presence;
=======
    /**
     * Attendance status for each user on a given date:
     * - 0: Absent (Score: 0)
     * - 1: Present (Score: 1)
     * - 2: Late less than 15 minutes (Score: 1)
     * - 3: Late more than 15 minutes (Score: 0.5)
     * - 4: Absent but justified (Score: 0.25)
     *
     * Scores are tentative and can be used for gradebook calculations.
     */
    #[Assert\NotNull]
    #[ORM\Column(name: 'presence', type: 'integer', nullable: true)]
    protected ?int $presence = null;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected User $user;

    #[ORM\ManyToOne(targetEntity: CAttendanceCalendar::class, inversedBy: 'sheets')]
    #[ORM\JoinColumn(name: 'attendance_calendar_id', referencedColumnName: 'iid', onDelete: 'CASCADE')]
    protected CAttendanceCalendar $attendanceCalendar;

    #[ORM\Column(name: 'signature', type: 'text', nullable: true)]
<<<<<<< HEAD
    protected string $signature;

    public function setPresence(bool $presence): self
=======
    protected ?string $signature;

    public function getIid(): ?int
    {
        return $this->iid;
    }

    public function setPresence(?int $presence): self
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        $this->presence = $presence;

        return $this;
    }

<<<<<<< HEAD
    public function getPresence(): bool
=======
    public function getPresence(): ?int
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return $this->presence;
    }

<<<<<<< HEAD
    public function setSignature(string $signature): static
=======
    public function setSignature(?string $signature): static
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        $this->signature = $signature;

        return $this;
    }

<<<<<<< HEAD
    public function getSignature(): string
=======
    public function getSignature(): ?string
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return $this->signature;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAttendanceCalendar(): CAttendanceCalendar
    {
        return $this->attendanceCalendar;
    }

    public function setAttendanceCalendar(CAttendanceCalendar $attendanceCalendar): self
    {
        $this->attendanceCalendar = $attendanceCalendar;

        return $this;
    }
}
