<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\DciExample\UseCase\TransferMoney\Role;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoneyContext;
use Koriym\MaDci\AbstractRole;

final class SourceAccountRole extends AbstractRole
{
    /**
     * @var TransferMoneyContext
     */
    protected $context;

    public function transfer(int $amount)
    {
        $destinationAccount = $this->context->destinationAccount;
        /* @var DestinationAccountRole $destinationAccount */
        $destinationAccount->deposit($amount);
        /* @var Account $this */
        $this->decreaseBalance($amount);
    }
}
