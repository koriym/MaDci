<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\DciExample\UseCase\TransferMoney\Role;

use Koriym\DciExample\Data\Account;
use Koriym\MaDci\AbstractRole;

final class DestinationAccountRole extends AbstractRole
{
    public function deposit(int $amount)
    {
        /* @var $this Account */
        $this->increaseBalance($amount);
    }
}
