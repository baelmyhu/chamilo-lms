<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CourseBundle\Entity;

<<<<<<< HEAD
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

=======
use ApiPlatform\Metadata\ApiResource;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['attendance_calendar:read']],
    denormalizationContext: ['groups' => ['attendance_calendar:write']],
    paginationEnabled: false,
    security: "is_granted('ROLE_TEACHER')"
)]
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
#[ORM\Table(name: 'c_attendance_calendar')]
#[ORM\Index(columns: ['done_attendance'], name: 'done_attendance')]
#[ORM\Entity]
class CAttendanceCalendar
{
    #[ORM\Column(name: 'iid', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
<<<<<<< HEAD
    protected ?int $iid = null;

    #[ORM\ManyToOne(targetEntity: CAttendance::class, cascade: ['remove'], inversedBy: 'calendars')]
    #[ORM\JoinColumn(name: 'attendance_id', referencedColumnName: 'iid', onDelete: 'CASCADE')]
    protected CAttendance $attendance;

    #[ORM\Column(name: 'date_time', type: 'datetime', nullable: false)]
    protected DateTime $dateTime;

    #[ORM\Column(name: 'done_attendance', type: 'boolean', nullable: false)]
    protected bool $doneAttendance;

    #[ORM\Column(name: 'blocked', type: 'boolean', nullable: false)]
    protected bool $blocked;

=======
    #[Groups(['attendance:read', 'attendance_calendar:read'])]
    protected ?int $iid = null;

    #[ORM\ManyToOne(targetEntity: CAttendance::class, inversedBy: 'calendars')]
    #[ORM\JoinColumn(name: 'attendance_id', referencedColumnName: 'iid', onDelete: 'CASCADE')]
    #[Groups(['attendance:write', 'attendance:read', 'attendance_calendar:read'])]
    protected CAttendance $attendance;

    #[ORM\Column(name: 'date_time', type: 'datetime', nullable: false)]
    #[Groups(['attendance:read', 'attendance:write', 'attendance_calendar:read', 'attendance_calendar:write'])]
    protected DateTime $dateTime;

    #[ORM\Column(name: 'done_attendance', type: 'boolean', nullable: false)]
    #[Groups(['attendance:read', 'attendance:write'])]
    protected bool $doneAttendance;

    #[ORM\Column(name: 'blocked', type: 'boolean', nullable: false)]
    #[Groups(['attendance:read', 'attendance:write'])]
    protected bool $blocked;

    #[ORM\Column(name: 'duration', type: 'integer', nullable: true)]
    #[Groups(['attendance:read', 'attendance:write', 'attendance_calendar:read', 'attendance_calendar:write'])]
    protected ?int $duration = null;

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    /**
     * @var Collection<int, CAttendanceSheet>
     */
    #[ORM\OneToMany(
        mappedBy: 'attendanceCalendar',
        targetEntity: CAttendanceSheet::class,
        cascade: ['persist', 'remove']
    )]
    protected Collection $sheets;

<<<<<<< HEAD
    #[ORM\Column(name: 'duration', type: 'integer', nullable: true)]
    protected ?int $duration = null;

=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    public function getIid(): ?int
    {
        return $this->iid;
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

    public function setDateTime(DateTime $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function setDoneAttendance(bool $doneAttendance): self
    {
        $this->doneAttendance = $doneAttendance;

        return $this;
    }

    public function getDoneAttendance(): bool
    {
        return $this->doneAttendance;
    }

    public function setBlocked(bool $blocked): self
    {
        $this->blocked = $blocked;

        return $this;
    }

    public function getBlocked(): bool
    {
        return $this->blocked;
    }

    /**
     * @return Collection<int, CAttendanceSheet>
     */
    public function getSheets(): Collection
    {
        return $this->sheets;
    }

    /**
     * @param Collection<int, CAttendanceSheet> $sheets
     */
    public function setSheets(Collection $sheets): self
    {
        $this->sheets = $sheets;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
