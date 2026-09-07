<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\DciExample\UseCase;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoney\Role\DestinationAccountRole;
use Koriym\DciExample\UseCase\TransferMoney\Role\SourceAccountRole;
use Koriym\MaDci\AbstractContext;
use Koriym\MaDci\RoleInjector;

final class TransferMoneyContext extends AbstractContext
{
    public readonly Account $sourceAccount;

    public readonly Account $destinationAccount;

    public function __construct(Account $sourceAccount, Account $destinationAccount)
    {
        $roleInjector = new RoleInjector($this);
        $this->sourceAccount = $roleInjector->inject($sourceAccount, [SourceAccountRole::class]);
        $this->destinationAccount = $roleInjector->inject($destinationAccount, [DestinationAccountRole::class]);
    }

    public function __invoke(int $amount): void
    {
        $this->sourceAccount->transfer($amount);
    }
}
