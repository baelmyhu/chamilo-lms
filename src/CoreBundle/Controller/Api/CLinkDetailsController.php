<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Controller\Api;

<<<<<<< HEAD
=======
use Chamilo\CoreBundle\Repository\AssetRepository;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Chamilo\CourseBundle\Entity\CLink;
use Chamilo\CourseBundle\Repository\CShortcutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CLinkDetailsController extends AbstractController
{
<<<<<<< HEAD
    public function __invoke(CLink $link, CShortcutRepository $shortcutRepository): Response
=======
    public function __invoke(CLink $link, CShortcutRepository $shortcutRepository, AssetRepository $assetRepository): Response
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        $shortcut = $shortcutRepository->getShortcutFromResource($link);
        $isOnHomepage = null !== $shortcut;

        $parentResourceNodeId = null;
        if ($link->getResourceNode() && $link->getResourceNode()->getParent()) {
            $parentResourceNodeId = $link->getResourceNode()->getParent()->getId();
        }

        $resourceLinkList = [];
        if ($link->getResourceLinkEntityList()) {
            foreach ($link->getResourceLinkEntityList() as $resourceLink) {
                $resourceLinkList[] = [
                    'visibility' => $resourceLink->getVisibility(),
                    'cid' => $resourceLink->getCourse()->getId(),
                    'sid' => $resourceLink->getSession()->getId(),
                ];
            }
        }

        $details = [
            'url' => $link->getUrl(),
            'title' => $link->getTitle(),
            'description' => $link->getDescription(),
            'onHomepage' => $isOnHomepage,
            'target' => $link->getTarget(),
            'parentResourceNodeId' => $parentResourceNodeId,
            'resourceLinkList' => $resourceLinkList,
            'category' => $link->getCategory()?->getIid(),
        ];

<<<<<<< HEAD
=======
        if (null !== $link->getCustomImage()) {
            $details['customImageUrl'] = $assetRepository->getAssetUrl($link->getCustomImage());
        } else {
            $details['customImageUrl'] = null;
        }

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        return $this->json($details, Response::HTTP_OK);
    }
}
