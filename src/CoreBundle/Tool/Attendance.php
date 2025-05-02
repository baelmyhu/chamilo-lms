<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Tool;

use Chamilo\CourseBundle\Entity\CAttendance;

class Attendance extends AbstractTool implements ToolInterface
{
    public function getTitle(): string
    {
        return 'attendance';
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return '/main/attendance/index.php';
=======
        return '/resources/attendance/:nodeId/';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getIcon(): string
    {
        return 'mdi-av-timer';
    }

    public function getCategory(): string
    {
        return 'authoring';
    }

    public function getResourceTypes(): ?array
    {
        return [
            'attendances' => CAttendance::class,
        ];
    }
}
