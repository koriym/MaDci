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

final class FakeRoleB extends AbstractRole
{
    protected function methods(AbstractContext $context): array
    {
        return ['replyB' => fn (): string => 'B'];
    }
}
