<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Controller\Api;

use Chamilo\CourseBundle\Entity\CDocument;
use Chamilo\CourseBundle\Repository\CDocumentRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
<<<<<<< HEAD

class CreateDocumentFileAction extends BaseResourceFileAction
{
    public function __invoke(Request $request, CDocumentRepository $repo, EntityManager $em, KernelInterface $kernel): CDocument
    {
=======
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateDocumentFileAction extends BaseResourceFileAction
{
    public function __invoke(
        Request $request,
        CDocumentRepository $repo,
        EntityManager $em,
        KernelInterface $kernel,
        TranslatorInterface $translator
    ): CDocument {
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        $isUncompressZipEnabled = $request->get('isUncompressZipEnabled', 'false');
        $fileExistsOption = $request->get('fileExistsOption', 'rename');

        $document = new CDocument();

        if ('true' === $isUncompressZipEnabled) {
            $result = $this->handleCreateFileRequestUncompress($document, $request, $em, $kernel);
        } else {
<<<<<<< HEAD
            $result = $this->handleCreateFileRequest($document, $repo, $request, $em, $fileExistsOption);
=======
            $result = $this->handleCreateFileRequest($document, $repo, $request, $em, $fileExistsOption, $translator);
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        }

        $document->setTitle($result['title']);
        $document->setFiletype($result['filetype']);
        $document->setComment($result['comment']);

        return $document;
    }
}
