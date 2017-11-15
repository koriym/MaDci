<?php
/**
 * This file is part of the Koriym.Ma package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\DciExample;

use Koriym\DciExample\Data\Account;
use Koriym\DciExample\UseCase\TransferMoneyContext;

require dirname(__DIR__) . '/vendor/autoload.php';

$sourceAccount = new Account(20);
$destinationAccount = new Account(30);
$moneyTransfer = new TransferMoneyContext($sourceAccount, $destinationAccount);
$moneyTransfer(10);
$moneyTransfer(5);
var_dump($sourceAccount->getBalance());
var_dump($destinationAccount->getBalance());
