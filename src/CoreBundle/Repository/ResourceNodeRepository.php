<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Repository;

use Chamilo\CoreBundle\Entity\Course;
use Chamilo\CoreBundle\Entity\ResourceFile;
use Chamilo\CoreBundle\Entity\ResourceNode;
use Chamilo\CoreBundle\Entity\ResourceType;
use Chamilo\CoreBundle\Entity\Session;
<<<<<<< HEAD
=======
use Chamilo\CoreBundle\ServiceHelper\AccessUrlHelper;
use Chamilo\CoreBundle\Settings\SettingsManager;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\MaterializedPathRepository;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Throwable;
use Vich\UploaderBundle\Storage\FlysystemStorage;

/**
 * @template-extends MaterializedPathRepository<ResourceNode>
 */
class ResourceNodeRepository extends MaterializedPathRepository
{
<<<<<<< HEAD
    protected FlysystemStorage $storage;
    protected FilesystemOperator $filesystem;
    protected RouterInterface $router;

    public function __construct(EntityManagerInterface $manager, FlysystemStorage $storage, FilesystemOperator $resourceFilesystem, RouterInterface $router)
    {
        parent::__construct($manager, $manager->getClassMetadata(ResourceNode::class));
        $this->storage = $storage;
        // Flysystem mount name is saved in config/packages/oneup_flysystem.yaml
        $this->filesystem = $resourceFilesystem;
        $this->router = $router;
=======
    protected FilesystemOperator $filesystem;

    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly FlysystemStorage $storage,
        private readonly FilesystemOperator $resourceFilesystem,
        private readonly RouterInterface $router,
        private readonly AccessUrlHelper $accessUrlHelper,
        private readonly SettingsManager $settingsManager
    ) {
        $this->filesystem = $resourceFilesystem; // Asignar el filesystem correcto
        parent::__construct($manager, $manager->getClassMetadata(ResourceNode::class));
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    public function getFilename(ResourceFile $resourceFile): ?string
    {
        return $this->storage->resolveUri($resourceFile);
    }

    /*public function create(ResourceNode $node): void
     * {
     * $this->getEntityManager()->persist($node);
     * $this->getEntityManager()->flush();
     * }
     * public function update(ResourceNode $node, bool $andFlush = true): void
     * {
     * //$node->setUpdatedAt(new \DateTime());
     * $this->getEntityManager()->persist($node);
     * if ($andFlush) {
     * $this->getEntityManager()->flush();
     * }
     * }*/
    public function getFileSystem(): FilesystemOperator
    {
        return $this->filesystem;
    }

<<<<<<< HEAD
    public function getResourceNodeFileContent(ResourceNode $resourceNode): string
    {
        try {
            $resourceFile = $resourceNode->getResourceFiles()->first();
=======
    public function getResourceNodeFileContent(ResourceNode $resourceNode, ?ResourceFile $resourceFile = null): string
    {
        try {
            $resourceFile ??= $resourceNode->getResourceFiles()->first();
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

            if ($resourceFile) {
                $fileName = $this->getFilename($resourceFile);

                return $this->getFileSystem()->read($fileName);
            }

            return '';
        } catch (Throwable $throwable) {
            throw new FileNotFoundException($resourceNode->getTitle());
        }
    }

    /**
     * @return false|resource
     */
<<<<<<< HEAD
    public function getResourceNodeFileStream(ResourceNode $resourceNode)
    {
        try {
            $resourceFile = $resourceNode->getResourceFiles()->first();
=======
    public function getResourceNodeFileStream(ResourceNode $resourceNode, ?ResourceFile $resourceFile = null)
    {
        try {
            $resourceFile ??= $resourceNode->getResourceFiles()->first();
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

            if ($resourceFile) {
                $fileName = $this->getFilename($resourceFile);

                return $this->getFileSystem()->readStream($fileName);
            }

            return false;
        } catch (Throwable $exception) {
            throw new FileNotFoundException($resourceNode->getTitle());
        }
    }

<<<<<<< HEAD
    public function getResourceFileUrl(ResourceNode $resourceNode, array $extraParams = [], ?int $referenceType = null): string
    {
        try {
            if ($resourceNode->hasResourceFile()) {
=======
    public function getResourceFileUrl(?ResourceNode $resourceNode, array $extraParams = [], ?int $referenceType = null, ?ResourceFile $resourceFile = null): string
    {
        try {
            $file = $resourceFile ?? $resourceNode?->getResourceFiles()->first();

            if ($file) {
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                $params = [
                    'tool' => $resourceNode->getResourceType()->getTool(),
                    'type' => $resourceNode->getResourceType(),
                    'id' => $resourceNode->getUuid(),
                ];

<<<<<<< HEAD
=======
                if ($resourceFile) {
                    $params['resourceFileId'] = $resourceFile->getId();
                }

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                if (!empty($extraParams)) {
                    $params = array_merge($params, $extraParams);
                }

                $referenceType ??= UrlGeneratorInterface::ABSOLUTE_PATH;

                $mode = $params['mode'] ?? 'view';
                // Remove mode from params and sent directly to the controller.
                unset($params['mode']);

                switch ($mode) {
                    case 'download':
                        return $this->router->generate('chamilo_core_resource_download', $params, $referenceType);

                    case 'view':
                        return $this->router->generate('chamilo_core_resource_view', $params, $referenceType);
                }
            }

            return '';
        } catch (Throwable $exception) {
            throw new FileNotFoundException($resourceNode->getTitle());
        }
    }

    /**
     * @todo filter files, check status
     */
    public function getSize(ResourceNode $resourceNode, ResourceType $type, ?Course $course = null, ?Session $session = null): int
    {
        $qb = $this->createQueryBuilder('node')
            ->select('SUM(file.size) as total')
            ->innerJoin('node.resourceFiles', 'file')
            ->innerJoin('node.resourceLinks', 'l')
            ->where('node.resourceType = :type')
            ->andWhere('node.parent = :parentNode')
            ->andWhere('file IS NOT NULL')
        ;

        $params = [];
        if (null !== $course) {
            $qb->andWhere('l.course = :course');
            $params['course'] = $course;
        }
        $params['parentNode'] = $resourceNode;
        $params['type'] = $type;

        $qb->setParameters($params);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
<<<<<<< HEAD
=======

    public function findByResourceTypeAndCourse(string $type, Course $course): array
    {
        $qb = $this->createQueryBuilder('node');

        return $qb
            ->innerJoin('node.resourceType', 'resourceType')
            ->innerJoin('node.resourceLinks', 'resourceLinks')
            ->where($qb->expr()->eq('resourceType.title', ':resourceType'))
            ->andWhere($qb->expr()->eq('resourceLinks.course', ':course'))
            ->setParameters([
                'resourceType' => $type,
                'course' => $course,
            ])
            ->getQuery()
            ->getResult()
        ;
    }
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
}
