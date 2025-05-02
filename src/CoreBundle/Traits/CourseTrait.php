<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Traits;

use Chamilo\CoreBundle\Entity\Course;

/**
 * Trait CourseTrait.
 */
trait CourseTrait
{
    /**
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function setCourse(Course $course): self
=======
    public function setCourse(?Course $course): self
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        $this->course = $course;

        return $this;
    }
}
