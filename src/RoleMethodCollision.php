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
 * A role declares a method that the Data object, or a role already bound to it in the same context, has too
 *
 * A real method is never routed through __call, so a role could not shadow a Data method;
 * and two roles of one context providing the same name would make bind order decide.
 * Rename the role method.
 */
final class RoleMethodCollision extends LogicException
{
}
