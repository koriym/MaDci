<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\DciExample\UseCase\TransferMoney\Role;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoneyContext;
use Koriym\MaDci\AbstractRole;

/**
 * @extends AbstractRole<TransferMoneyContext>
 *
 * @mixin Account
 */
final class DestinationAccountRole extends AbstractRole
{
    public function deposit(int $amount): void
    {
        $this->increaseBalance($amount);
    }
}
