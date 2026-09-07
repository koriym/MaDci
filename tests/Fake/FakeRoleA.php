<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci\Fake;

use Koriym\MaDci\AbstractRole;

final class FakeRoleA extends AbstractRole
{
    public function greet(): string
    {
        return 'A';
    }

    public function askB(): string
    {
        return $this->replyB();
    }
}
