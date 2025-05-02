<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Tool;

class NotebookTeacher extends AbstractPlugin
{
    public function getTitle(): string
    {
<<<<<<< HEAD
        return 'notebookteacher';
=======
        return 'NotebookTeacher';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return '/plugin/notebookteacher/start.php';
=======
        return '/plugin/NotebookTeacher/start.php';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getIcon(): string
    {
        return 'mdi-note-edit';
    }

    public function getTitleToShow(): string
    {
        return 'Teacher notes';
    }
}
