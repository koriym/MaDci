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
use Koriym\MaDci\AbstractContext;
use Koriym\MaDci\AbstractRole;

/**
 * @extends AbstractRole<TransferMoneyContext>
 *
 * @mixin Account
 */
final class SourceAccountRole extends AbstractRole
{
    /** @param TransferMoneyContext $context */
    protected function methods(AbstractContext $context): array
    {
        return [
            'transfer' => function (int $amount) use ($context): void {
                $context->destinationAccount->deposit($amount);
                $this->decreaseBalance($amount);
            },
        ];
    }
}
