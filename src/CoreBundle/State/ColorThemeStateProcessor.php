<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Chamilo\CoreBundle\Entity\AccessUrlRelColorTheme;
use Chamilo\CoreBundle\Entity\ColorTheme;
use Chamilo\CoreBundle\ServiceHelper\AccessUrlHelper;
use Doctrine\ORM\EntityManagerInterface;
<<<<<<< HEAD
use League\Flysystem\FilesystemException;
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

use const DIRECTORY_SEPARATOR;
use const PHP_EOL;

<<<<<<< HEAD
=======
/**
 * @implements ProcessorInterface<ColorTheme, ColorTheme|void>
 */
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
final class ColorThemeStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly ProcessorInterface $persistProcessor,
        private readonly AccessUrlHelper $accessUrlHelper,
        private readonly EntityManagerInterface $entityManager,
        #[Autowire(service: 'oneup_flysystem.themes_filesystem')]
        private readonly FilesystemOperator $filesystem,
    ) {}

<<<<<<< HEAD
    /**
     * @param mixed $data
     *
     * @throws FilesystemException
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
=======
    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): ?ColorTheme
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        \assert($data instanceof ColorTheme);

        /** @var ColorTheme $colorTheme */
        $colorTheme = $this->persistProcessor->process($data, $operation, $uriVariables, $context);

        if ($colorTheme) {
            $accessUrl = $this->accessUrlHelper->getCurrent();

            $accessUrlRelColorTheme = $accessUrl->getColorThemeByTheme($colorTheme);

            if (!$accessUrlRelColorTheme) {
                $accessUrlRelColorTheme = (new AccessUrlRelColorTheme())->setColorTheme($colorTheme);

                $this->accessUrlHelper->getCurrent()->addColorTheme($accessUrlRelColorTheme);
            }

            $this->entityManager->flush();

            $contentParts = [];
            $contentParts[] = ':root {';

            foreach ($colorTheme->getVariables() as $variable => $value) {
                $contentParts[] = "  $variable: $value;";
            }

            $contentParts[] = '}';

            $this->filesystem->createDirectory($colorTheme->getSlug());
            $this->filesystem->write(
                $colorTheme->getSlug().DIRECTORY_SEPARATOR.'colors.css',
                implode(PHP_EOL, $contentParts)
            );
        }

        return $colorTheme;
    }
}
