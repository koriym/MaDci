<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

final class RoleInjector
{
    public function __construct(private readonly AbstractContext $context)
    {
    }

    /**
     * Bind roles to a Data object and return that same object
     *
     * @template T of object
     *
     * @param T                                $data
     * @param list<class-string<AbstractRole>> $rolesClass
     *
     * @return T
     */
    public function inject(object $data, array $rolesClass): object
    {
        foreach ($rolesClass as $roleClass) {
            RoleRegistry::bind($data, new $roleClass(), $this->context);
        }

        return $data;
    }
}
