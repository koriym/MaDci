<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use BadMethodCallException;

/**
 * No role bound to the object by a live context provides the called method
 *
 * The Data object has no such method of its own either. Bind the role first,
 * and keep the context that bound it alive while calling.
 */
final class RoleMethodNotFound extends BadMethodCallException
{
}
