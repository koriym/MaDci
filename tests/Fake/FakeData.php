<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci\Fake;

use Koriym\MaDci\RolePlayer;

final class FakeData
{
    use RolePlayer;

    public function name(): string
    {
        return 'data';
    }

    public function greetViaThis(): string
    {
        return $this->greet();
    }
}
