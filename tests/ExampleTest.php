<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoneyContext;
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function testTransferMoney(): void
    {
        $sourceAccount = new Account(20);
        $destinationAccount = new Account(30);
        $transferMoney = new TransferMoneyContext($sourceAccount, $destinationAccount);
        $transferMoney(10);
        $transferMoney(5);
        $this->assertSame(5, $sourceAccount->getBalance());
        $this->assertSame(45, $destinationAccount->getBalance());
    }

    public function testContextHoldsTheAccountsThemselves(): void
    {
        $sourceAccount = new Account(20);
        $destinationAccount = new Account(30);
        $transferMoney = new TransferMoneyContext($sourceAccount, $destinationAccount);
        $this->assertSame($sourceAccount, $transferMoney->sourceAccount);
        $this->assertSame($destinationAccount, $transferMoney->destinationAccount);
    }
}
