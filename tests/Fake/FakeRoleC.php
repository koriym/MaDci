<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci\Fake;

use Koriym\MaDci\AbstractRole;

final class FakeRoleC extends AbstractRole
{
    public function greet(): string
    {
        return 'C';
    }
}
