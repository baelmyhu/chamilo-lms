<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Tool;

class Zoom extends AbstractPlugin
{
    public function getTitle(): string
    {
<<<<<<< HEAD
        return 'zoom';
=======
        return 'Zoom';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return 'plugin/zoom/start.php';
=======
        return 'plugin/Zoom/start.php';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getIcon(): string
    {
        return 'mdi-video-box';
    }

    public function getTitleToShow(): string
    {
        return 'Zoom Videoconference';
    }
}
