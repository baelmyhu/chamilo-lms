<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Tool;

class Mobidico extends AbstractTool implements ToolInterface
{
    public function getTitle(): string
    {
<<<<<<< HEAD
        return 'mobidico';
=======
        return 'Mobidico';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getTitleToShow(): string
    {
        return 'Mobidico';
    }

    public function getIcon(): string
    {
        return 'mdi-book-alphabet';
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return '/plugin/mobidico/start.php';
=======
        return '/plugin/Mobidico/start.php';
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
