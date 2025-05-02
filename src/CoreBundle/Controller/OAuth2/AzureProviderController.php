<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Controller\OAuth2;

use Chamilo\CoreBundle\ServiceHelper\AuthenticationConfigHelper;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

<<<<<<< HEAD
class AzureProviderController extends AbstractProviderController
=======
class AzureProviderController extends AbstractOAuth2ProviderController
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
{
    #[Route('/connect/azure', name: 'chamilo.oauth2_azure_start')]
    public function connect(
        ClientRegistry $clientRegistry,
        AuthenticationConfigHelper $authenticationConfigHelper,
    ): Response {
        return $this->getStartResponse('azure', $clientRegistry, $authenticationConfigHelper);
    }

    #[Route('/connect/azure/check', name: 'chamilo.oauth2_azure_check')]
    public function connectCheck(): void {}
}
