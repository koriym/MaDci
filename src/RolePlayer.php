<?php
/**
 * This file is part of the Koriym.Ma package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\MaDci;

final class RolePlayer
{
    /**
     * @var AbstractRole[]
     */
    private $roles = [];

    private $data;

    public function __construct($data, array $roles)
    {
        $this->data = $data;
        $this->roles = $roles;
    }

    /**
     * Invoke role method or original method
     */
    public function __call($name, $arguments)
    {
        foreach ($this->roles as $role) {
            if (method_exists($role, $name)) {
                return call_user_func_array([$role, $name], $arguments);
            }
        }
        if (method_exists($this->data, $name)) {
            return call_user_func_array([$this->data, $name], $arguments);
        }

        throw new \BadMethodCallException($name);
    }

    public function addRoles(array $roles)
    {
        $this->roles += $roles;
    }

    public function removeRoles()
    {
        $this->roles = [];
    }

    public function isCallable(string $name) : bool
    {
        foreach ($this->roles as $role) {
            if (method_exists($role, $name)) {
                return true;
            }
        }

        return false;
    }
}
