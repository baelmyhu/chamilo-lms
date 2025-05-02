<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
<<<<<<< HEAD
use Chamilo\CoreBundle\Entity\Skill;
use Chamilo\CoreBundle\Repository\SkillRepository;
=======
use Chamilo\CoreBundle\DataTransformer\SkillTreeNodeTransformer;
use Chamilo\CoreBundle\Entity\Skill;
use Chamilo\CoreBundle\Repository\SkillRepository;
use Chamilo\CoreBundle\Settings\SettingsManager;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Doctrine\Common\Collections\Collection;

/**
 * @implements ProviderInterface<Skill>
 */
readonly class SkillTreeStateProvider implements ProviderInterface
{
<<<<<<< HEAD
    public function __construct(
        private SkillRepository $skillRepo,
    ) {}
=======
    private SkillTreeNodeTransformer $transformer;

    public function __construct(
        private SkillRepository $skillRepo,
        private SettingsManager $settingsManager,
    ) {
        $this->transformer = new SkillTreeNodeTransformer(
            $this->settingsManager
        );
    }
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|Collection
    {
        /** @var Skill $root */
        $root = $this->skillRepo->findOneBy([], ['id' => 'ASC']);

        if (!$root) {
            return [];
        }

<<<<<<< HEAD
        return $root->getChildSkills();
=======
        return $root->getChildSkills()
            ->map(fn (Skill $childSkill) => $this->transformer->transform($childSkill))
        ;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }
}
