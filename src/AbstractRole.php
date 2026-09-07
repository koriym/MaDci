<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use WeakReference;

/**
 * @template TContext of AbstractContext
 */
abstract class AbstractRole
{
    /**
     * Weak, or a context could never be collected on PHP 8.2, where a WeakMap value that refers back to its key is kept alive
     *
     * @var WeakReference<TContext>
     */
    private readonly WeakReference $contextRef;

    /**
     * @param object   $data
     * @param TContext $context
     */
    public function __construct(protected object $data, AbstractContext $context)
    {
        $this->contextRef = WeakReference::create($context);
    }

    public function __call(string $name, array $arguments): mixed
    {
        return $this->data->{$name}(...$arguments);
    }

    /**
     * @return TContext
     */
    protected function context(): AbstractContext
    {
        $context = $this->contextRef->get();
        assert($context instanceof AbstractContext);

        return $context;
    }
}
