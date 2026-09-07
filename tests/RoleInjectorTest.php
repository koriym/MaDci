<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoney\Role\DestinationAccountRole;
use Koriym\MaDci\Fake\FakeContext;
use Koriym\MaDci\Fake\FakePlainData;
use Koriym\MaDci\Fake\FakeRoleA;
use PHPUnit\Framework\TestCase;

final class RoleInjectorTest extends TestCase
{
    public function testInjectReturnsTheObjectItWasGiven(): void
    {
        $context = new FakeContext();
        $account = new Account(20);
        $injected = (new RoleInjector($context))->inject($account, [DestinationAccountRole::class]);
        $this->assertSame($account, $injected);
    }

    public function testRoleMethodAnswersThroughTheOriginalReference(): void
    {
        $context = new FakeContext();
        $account = new Account(20);
        (new RoleInjector($context))->inject($account, [DestinationAccountRole::class]);
        $account->deposit(10);
        $this->assertSame(30, $account->getBalance());
    }

    public function testDataWithoutTheTraitIsRejected(): void
    {
        $this->expectException(NotRolePlayer::class);
        (new RoleInjector(new FakeContext()))->inject(new FakePlainData(), [FakeRoleA::class]);
    }
}
