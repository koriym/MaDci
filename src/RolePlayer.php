<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

trait RolePlayer
{
    public function __call(string $name, array $arguments): mixed
    {
        return RoleRegistry::dispatch($this, $name, $arguments);
    }
}
