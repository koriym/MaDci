<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\DciExample\Data;

final class Account
{
    /**
     * @var int
     */
    private $balance = 0;

    public function __construct(int $initialBalanace)
    {
        $this->balance = $initialBalanace;
    }

    public function getBalance() : int
    {
        return $this->balance;
    }

    public function increaseBalance(int $amount) : void
    {
        $this->balance += $amount;
    }

    public function decreaseBalance(int $amount) : void
    {
        $this->balance -= $amount;
    }
}
