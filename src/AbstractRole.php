<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use Closure;

/**
 * @template TContext of AbstractContext
 */
abstract class AbstractRole
{
    /**
     * @return array<string, Closure>
     */
    final public function playedBy(object $data, AbstractContext $context): array
    {
        return array_map(
            static fn (Closure $method): Closure => Closure::bind($method, $data),
            $this->methods($context),
        );
    }

    /**
     * Role methods by name, each a closure that runs with $this bound to the Data object
     *
     * @param TContext $context
     *
     * @return array<string, Closure>
     */
    abstract protected function methods(AbstractContext $context): array;
}
