<?php
/**
 * This file is part of the Koriym.Ma package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\DciExample\UseCase;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoney\Role\DestinationAccountRole;
use Koriym\DciExample\UseCase\TransferMoney\Role\SourceAccountRole;
use Koriym\MaDci\AbstractContext;
use Koriym\MaDci\RoleInjector;

final class TransferMoneyContext extends AbstractContext
{
    /**
     * @var SourceAccountRole
     */
    public $sourceAccount;

    /**
     * @var DestinationAccountRole
     */
    public $destinationAccount;

    public function __construct(Account $sourceAccount, Account $destinationAccount)
    {
        $roleInjector = new RoleInjector($this);
        $this->sourceAccount = $roleInjector->inject($sourceAccount, [SourceAccountRole::class]);
        $this->destinationAccount = $roleInjector->inject($destinationAccount, [DestinationAccountRole::class]);
    }

    public function __invoke(int $amount)
    {
        $this->sourceAccount->transfer($amount);
    }
}
