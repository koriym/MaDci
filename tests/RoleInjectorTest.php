<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\MaDci;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoney\Role\DestinationAccountRole;
use Koriym\DciExample\UseCase\TransferMoney\Role\SourceAccountRole;
use Koriym\DciExample\UseCase\TransferMoneyContext;
use PHPUnit\Framework\TestCase;

class RoleInjectorTest extends TestCase
{
    public function testRoleInjector()
    {
        $context = (new \ReflectionClass(TransferMoneyContext::class))->newInstanceWithoutConstructor();
        /* @var $context TransferMoneyContext */
        $injector = new RoleInjector($context);
        $sourceData = new Account(20);
        $sourceAccount = $injector->inject($sourceData, [SourceAccountRole::class]);
        /* @var $sourceAccount RolePlayer */
        $this->assertTrue($sourceAccount->isCallable('transfer'));
        $destinationData = new Account(20);
        $destinationAccount = $injector->inject($destinationData, [DestinationAccountRole::class]);
        /* @var $sourceAccount RolePlayer */
        $this->assertTrue($destinationAccount->isCallable('deposit'));
        /* @var $destinationAccount DestinationAccountRole */
        $destinationAccount->deposit(10);
        /* @var $destinationAccount Account */
        $balance = $destinationAccount->getBalance();
        $this->assertSame(30, $balance);
    }
}
