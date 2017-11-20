<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\MaDci;

final class RoleInjector
{
    /**
     * @var AbstractContext
     */
    private $context;

    public function __construct(AbstractContext $context)
    {
        $this->context = $context;
    }

    /**
     * Return role-injected proxy object
     */
    public function inject($data, array $rolesClass)
    {
        $roles = [];
        foreach ($rolesClass as $role) {
            $roles[] = new $role($data, $this->context);
        }

        return new RolePlayer($data, $roles);
    }
}
