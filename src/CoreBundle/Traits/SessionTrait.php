<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Traits;

use Chamilo\CoreBundle\Entity\Session;

trait SessionTrait
{
    protected ?Session $session = null;

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

<<<<<<< HEAD
    public function setSession(Session $session): self
=======
    public function setSession(?Session $session): self
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        $this->session = $session;

        return $this;
    }
}
