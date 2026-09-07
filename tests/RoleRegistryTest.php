<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use Koriym\MaDci\Fake\FakeContext;
use Koriym\MaDci\Fake\FakeData;
use Koriym\MaDci\Fake\FakeRoleA;
use Koriym\MaDci\Fake\FakeRoleB;
use Koriym\MaDci\Fake\FakeRoleC;
use Koriym\MaDci\Fake\FakeRoleWithName;
use PHPUnit\Framework\TestCase;

final class RoleRegistryTest extends TestCase
{
    public function testRoleReachesAnotherRoleOfTheSameObjectThroughThis(): void
    {
        $context = new FakeContext();
        $data = new FakeData();
        (new RoleInjector($context))->inject($data, [FakeRoleA::class, FakeRoleB::class]);
        $this->assertSame('B', $data->askB());
    }

    public function testDataMethodReachesRoleThroughThis(): void
    {
        $context = new FakeContext();
        $data = new FakeData();
        (new RoleInjector($context))->inject($data, [FakeRoleA::class]);
        $this->assertSame('A', $data->greetViaThis());
    }

    public function testUnboundMethodIsNotFound(): void
    {
        $this->expectException(RoleMethodNotFound::class);
        (new FakeData())->greet();
    }

    public function testRoleMayNotShadowDataMethod(): void
    {
        $this->expectException(RoleMethodCollision::class);
        (new RoleInjector(new FakeContext()))->inject(new FakeData(), [FakeRoleWithName::class]);
    }

    public function testTwoRolesOfOneContextMayNotShareMethod(): void
    {
        $this->expectException(RoleMethodCollision::class);
        (new RoleInjector(new FakeContext()))->inject(new FakeData(), [FakeRoleA::class, FakeRoleC::class]);
    }

    public function testRolesGoAwayWithTheirContext(): void
    {
        $context = new FakeContext();
        $data = new FakeData();
        (new RoleInjector($context))->inject($data, [FakeRoleA::class]);
        $this->assertSame('A', $data->greet());
        unset($context);
        $this->expectException(RoleMethodNotFound::class);
        $data->greet();
    }

    public function testLatestContextAnswersFirst(): void
    {
        $outer = new FakeContext();
        $data = new FakeData();
        (new RoleInjector($outer))->inject($data, [FakeRoleA::class]);
        $inner = new FakeContext();
        (new RoleInjector($inner))->inject($data, [FakeRoleC::class]);
        $this->assertSame('C', $data->greet());
        unset($inner);
        $this->assertSame('A', $data->greet());
    }
}
