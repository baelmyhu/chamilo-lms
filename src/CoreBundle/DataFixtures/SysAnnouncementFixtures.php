<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\DataFixtures;

use Chamilo\CoreBundle\Entity\SysAnnouncement;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SysAnnouncementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $url = $this->getReference(AccessUserFixtures::ACCESS_URL_REFERENCE);

        $content = '<p>
                        <img src="/img/document/images/mr_chamilo/svg/collaborative.svg" width="320" height="340" />
                    </p>
<<<<<<< HEAD
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur.
=======
                    If this is your first time using Chamilo, make sure you check the side menu to find your way through
                    its many features. If you need help, you will find
                    <a href="https://docs.chamilo.org">our official docs</a> can help for standard documentation, while
                    our <a href="https://github.com/chamilo/chamilo-lms/discussions">online forum</a> can help
                    share ideas and find answers from other Chamilo users.
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                    ';

        $sysAnnouncement = (new SysAnnouncement())
            ->setTitle('Welcome to Chamilo!')
            ->setContent($content)
            ->setUrl($url)
            ->setDateStart(new DateTime())
            ->setDateEnd(new DateTime('now +30 days'))
            ->addRole('ROLE_ANONYMOUS')
            ->addRole('ROLE_USER') // connected users
        ;
        $manager->persist($sysAnnouncement);
        $manager->flush();
    }
}
