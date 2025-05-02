<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\DataTransformer;

<<<<<<< HEAD
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Chamilo\CoreBundle\ApiResource\CourseTool;
use Chamilo\CoreBundle\Entity\Course;
use Chamilo\CoreBundle\Tool\AbstractTool;
use Chamilo\CoreBundle\Tool\ToolChain;
use Chamilo\CoreBundle\Traits\CourseFromRequestTrait;
use Chamilo\CourseBundle\Entity\CTool;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

<<<<<<< HEAD
class CourseToolDataTranformer implements DataTransformerInterface
=======
class CourseToolDataTranformer
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
{
    use CourseFromRequestTrait;

    public function __construct(
        protected RequestStack $requestStack,
        protected EntityManagerInterface $entityManager,
        protected readonly ToolChain $toolChain,
    ) {}

<<<<<<< HEAD
    public function transform($object, string $to, array $context = []): object
    {
        \assert($object instanceof CTool);

=======
    public function transform(CTool $object): CourseTool
    {
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        $tool = $object->getTool();

        $toolModel = $this->toolChain->getToolFromName(
            $tool->getTitle()
        );

        $course = $this->getCourse();

        $cTool = new CourseTool();
        $cTool->iid = $object->getIid();
        $cTool->title = $object->getTitle();
        $cTool->visibility = $object->getVisibility();
        $cTool->resourceNode = $object->resourceNode;
        $cTool->illustrationUrl = $object->illustrationUrl;
        $cTool->url = $this->generateToolUrl($toolModel, $course);
        $cTool->tool = $toolModel;

        return $cTool;
    }

    private function generateToolUrl(AbstractTool $tool, Course $course): string
    {
        $link = $tool->getLink();

        if (strpos($link, 'nodeId')) {
            $nodeId = (string) $course->getResourceNode()->getId();
            $link = str_replace(':nodeId', $nodeId, $link);
        }

        return $link.'?'
            .http_build_query([
                'cid' => $this->getCourse()->getId(),
                'sid' => $this->getSession()?->getId(),
                'gid' => 0,
            ]);
    }
<<<<<<< HEAD

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof CTool && CourseTool::class === $to;
    }
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
}
