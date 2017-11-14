<?php
/**
 * This file is part of the Koriym.Ma package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\MaDci;

final class RoleInjector
{
    private $context;

    public function __construct(AbstractContext $context)
    {
        $this->context = $context;
    }

    /**
     * Return role-injected object
     */
    public function inject($data, array $rolesClass)
    {
        $roles = [];
        foreach ($rolesClass as $role) {
            $roles[] = new $role($data, $this->context);
        }
        $rolePlayer = new RolePlayer($data, $roles);

        return $rolePlayer;
    }
}
