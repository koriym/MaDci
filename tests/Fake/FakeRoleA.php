<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci\Fake;

use Koriym\MaDci\AbstractContext;
use Koriym\MaDci\AbstractRole;

final class FakeRoleA extends AbstractRole
{
    protected function methods(AbstractContext $context): array
    {
        return [
            'greet' => fn (): string => 'A',
            'askB' => fn (): string => $this->replyB(),
            'itself' => fn (): object => $this,
            'peek' => fn (): string => $this->secret(),
        ];
    }
}
