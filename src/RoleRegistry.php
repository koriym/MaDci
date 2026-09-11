<?php

/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Koriym\MaDci;

use SplObjectStorage;
use WeakMap;
use WeakReference;

/**
 * Holds the roles each context has bound to each object, and answers role method calls
 *
 * A context owns its bindings and they are dropped with it. The object side keeps only
 * weak references to its contexts, so a long-lived Data object never keeps a context alive.
 */
final class RoleRegistry
{
    /** @var WeakMap<AbstractContext, SplObjectStorage<object, list<AbstractRole>>>|null */
    private static ?WeakMap $byContext = null;

    /** @var WeakMap<object, list<WeakReference<AbstractContext>>>|null */
    private static ?WeakMap $byData = null;

    /** @var array<class-string<AbstractRole>, list<string>> */
    private static array $methods = [];

    public static function bind(object $data, AbstractRole $role, AbstractContext $context): void
    {
        if (! self::isRolePlayer($data)) {
            throw new NotRolePlayer($data::class);
        }
        $bound = self::byContext()[$context] ??= new SplObjectStorage();
        $roles = $bound[$data] ?? [];
        self::$methods[$role::class] ??= array_keys($role->playedBy($data, $context));
        foreach (self::$methods[$role::class] as $method) {
            self::assertFree($roles, $data, $method);
        }
        $bound[$data] = [...$roles, $role];
        $others = array_filter(
            self::byData()[$data] ?? [],
            static fn (WeakReference $ref): bool => $ref->get() !== null && $ref->get() !== $context,
        );
        self::byData()[$data] = [...$others, WeakReference::create($context)];
    }

    public static function dispatch(object $data, string $name, array $arguments): mixed
    {
        foreach (array_reverse(self::byData()[$data] ?? []) as $ref) {
            $context = $ref->get();
            if ($context === null) {
                continue;
            }
            foreach (self::byContext()[$context][$data] ?? [] as $role) {
                if (in_array($name, self::$methods[$role::class], true)) {
                    return $role->playedBy($data, $context)[$name](...$arguments);
                }
            }
        }

        throw new RoleMethodNotFound($data::class . '::' . $name);
    }

    /**
     * @param list<AbstractRole> $roles
     */
    private static function assertFree(array $roles, object $data, string $method): void
    {
        if (method_exists($data, $method)) {
            throw new RoleMethodCollision($data::class . '::' . $method);
        }
        foreach ($roles as $bound) {
            if (in_array($method, self::$methods[$bound::class], true)) {
                throw new RoleMethodCollision($bound::class . '::' . $method);
            }
        }
    }

    private static function isRolePlayer(object $data): bool
    {
        $class = $data::class;
        while ($class !== false) {
            if (in_array(RolePlayer::class, class_uses($class) ?: [], true)) {
                return true;
            }
            $class = get_parent_class($class);
        }

        return false;
    }

    /**
     * @return WeakMap<AbstractContext, SplObjectStorage<object, list<AbstractRole>>>
     */
    private static function byContext(): WeakMap
    {
        return self::$byContext ??= new WeakMap();
    }

    /**
     * @return WeakMap<object, list<WeakReference<AbstractContext>>>
     */
    private static function byData(): WeakMap
    {
        return self::$byData ??= new WeakMap();
    }
}
