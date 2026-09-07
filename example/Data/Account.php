<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\DciExample\Data;

use Koriym\MaDci\RolePlayer;

final class Account
{
    use RolePlayer;

    public function __construct(private int $balance)
    {
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function increaseBalance(int $amount): void
    {
        $this->balance += $amount;
    }

    public function decreaseBalance(int $amount): void
    {
        $this->balance -= $amount;
    }
}
