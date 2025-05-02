<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Tool;

class CustomCertificate extends AbstractPlugin
{
    public function getTitle(): string
    {
<<<<<<< HEAD
        return 'customcertificate';
=======
        return 'CustomCertificate';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getLink(): string
    {
<<<<<<< HEAD
        return '/plugin/customcertificate/start.php';
=======
        return '/plugin/CustomCertificate/start.php';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getIcon(): string
    {
        return 'mdi-certificate-outline';
    }

    public function getTitleToShow(): string
    {
        return 'Custom certificate';
    }
}
