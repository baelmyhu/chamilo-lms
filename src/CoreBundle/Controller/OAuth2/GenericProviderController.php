<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Controller\OAuth2;

use Chamilo\CoreBundle\ServiceHelper\AuthenticationConfigHelper;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

<<<<<<< HEAD
class GenericProviderController extends AbstractProviderController
=======
class GenericProviderController extends AbstractOAuth2ProviderController
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
{
    #[Route('/connect/generic', name: 'chamilo.oauth2_generic_start')]
    public function connect(
        ClientRegistry $clientRegistry,
        AuthenticationConfigHelper $authenticationConfigHelper,
    ): Response {
        return $this->getStartResponse('generic', $clientRegistry, $authenticationConfigHelper);
    }

    #[Route('/connect/generic/check', name: 'chamilo.oauth2_generic_check')]
    public function connectCheck(): void {}
}
