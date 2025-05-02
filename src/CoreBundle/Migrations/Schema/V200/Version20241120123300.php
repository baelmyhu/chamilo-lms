<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Migrations\Schema\V200;

use Chamilo\CoreBundle\Migrations\AbstractMigrationChamilo;
use Chamilo\CourseBundle\Entity\CTool;
use Doctrine\DBAL\Schema\Schema;

final class Version20241120123300 extends AbstractMigrationChamilo
{
    public function getDescription(): string
    {
<<<<<<< HEAD
        return 'Remove session-specific tools and related entities, keeping only course-base tools.';
=======
        return 'Remove session-specific tools and related entities, keeping only course-base tools, excluding course_homepage.';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function up(Schema $schema): void
    {
        $repository = $this->entityManager->getRepository(CTool::class);

        $queryBuilder = $repository->createQueryBuilder('ct');
<<<<<<< HEAD
        $queryBuilder->where('ct.session IS NOT NULL');
=======
        $queryBuilder
            ->where('ct.session IS NOT NULL')
            ->andWhere('ct.title != :excludedTitle')
            ->setParameter('excludedTitle', 'course_homepage')
        ;

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        $sessionTools = $queryBuilder->getQuery()->getResult();

        foreach ($sessionTools as $tool) {
            $this->entityManager->remove($tool);
            error_log(\sprintf('Removed tool: %s (ID: %d)', $tool->getTitle(), $tool->getIid()));
        }

        $this->entityManager->flush();
    }
}
