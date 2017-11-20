<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\MaDci;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoneyContext;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $sourceAccount = new Account(20);
        $destinationAccount = new Account(30);
        $moneytransfer = new TransferMoneyContext($sourceAccount, $destinationAccount);
        /* @var $moneytransfer TransferMoneyContext */
        $moneytransfer(10);
        $moneytransfer(5);
        $this->assertSame(5, $sourceAccount->getBalance());
        $this->assertSame(45, $destinationAccount->getBalance());
    }
}
