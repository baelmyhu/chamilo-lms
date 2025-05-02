<?php

declare(strict_types=1);

namespace Chamilo\CoreBundle\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Chamilo\CoreBundle\Entity\AccessUrlRelColorTheme;
use Chamilo\CoreBundle\ServiceHelper\AccessUrlHelper;
<<<<<<< HEAD
=======
use Doctrine\Common\Collections\Collection;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

/**
 * @template-implements ProviderInterface<AccessUrlRelColorTheme>
 */
<<<<<<< HEAD
class AccessUrlRelColorThemeStateProvider implements ProviderInterface
{
    public function __construct(
        private readonly AccessUrlHelper $accessUrlHelper,
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = [])
=======
readonly class AccessUrlRelColorThemeStateProvider implements ProviderInterface
{
    public function __construct(
        private AccessUrlHelper $accessUrlHelper,
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Collection
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        $colorThemes = $this->accessUrlHelper->getCurrent()->getColorThemes();

        if (0 == $colorThemes->count()) {
            $colorThemes = $this->accessUrlHelper->getFirstAccessUrl()->getColorThemes();
        }

        return $colorThemes;
    }
}
