<?php
/**
 * This file is part of the Koriym.MaDci package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\MaDci;

abstract class AbstractRole
{
    /**
     * The underlying data object
     *
     * @var object
     */
    public $data;

    /**
     * The context to which this role belongs
     *
     * @var AbstractContext
     */
    protected $context;

    public function __construct($data, AbstractContext $context)
    {
        $this->data = $data;
        $this->context = $context;
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->data, $name], $arguments);
    }
}
