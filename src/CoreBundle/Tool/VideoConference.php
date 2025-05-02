<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Tool;

class VideoConference extends AbstractTool implements ToolInterface
{
    public function getTitle(): string
    {
<<<<<<< HEAD
        return 'bbb';
=======
        return 'Bbb';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getTitleToShow(): string
    {
        return 'Videoconference';
    }

    public function getIcon(): string
    {
        return 'mdi-video';
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return '/plugin/bbb/start.php';
=======
        return '/plugin/Bbb/start.php';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getCategory(): string
    {
        return 'plugin';
    }

    public function getResourceTypes(): ?array
    {
        return [
        ];
    }
}
