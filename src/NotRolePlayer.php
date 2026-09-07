<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use LogicException;

/**
 * The Data object given to RoleInjector::inject() does not use the RolePlayer trait
 *
 * Role methods are answered by the __call the trait provides, so without it the object
 * could never respond to them. Add `use RolePlayer;` to the Data class.
 */
final class NotRolePlayer extends LogicException
{
}
