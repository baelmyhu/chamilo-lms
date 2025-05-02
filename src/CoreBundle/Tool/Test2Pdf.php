<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Tool;

class Test2Pdf extends AbstractPlugin
{
    public function getTitle(): string
    {
<<<<<<< HEAD
        return 'test2pdf';
=======
        return 'Test2Pdf';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return '/plugin/test2pdf/start.php';
=======
        return '/plugin/Test2Pdf/start.php';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getIcon(): string
    {
        return 'mdi-file-pdf-box';
    }

    public function getTitleToShow(): string
    {
        return 'Test to Pdf (Test2Pdf)';
    }
}
