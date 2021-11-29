<?php

declare(strict_types=1);

namespace App\Enums;

use Closure;
use ReflectionClass;
use RuntimeException;

/**
 * Class Enum.
 */
abstract class Enum
{
    /** @var null */
    private static $constCacheArray = null;
    /** @var mixed */
    private $value;

    /**
     * @param $value
     */
    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $name
     * @return static
     */
    public static function byName($name)
    {
        if (!self::isValidName($name)) {
            throw new RuntimeException('Bad name . ' . $name . ' for ' . get_called_class());
        }

        $value = self::getConstants()[$name];

        return new static($value);
    }

    /**
     * @param $value
     * @return static
     */
    public static function byValue($value)
    {
        if (!self::isValidValue($value)) {
            throw new RuntimeException('Bad value . ' . $value . ' for ' . get_called_class());
        }

        return new static($value);
    }

    public function getKeyByValue()
    {
        $const = array_flip(self::getConstants());

        return $const[self::getValue()] ?? null;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public static function getConstants()
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param $name
     * @param bool $strict
     * @return bool
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));

        return in_array(strtolower($name), $keys);
    }

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     */
    public static function isValidValue($value, $strict = false)
    {
        $values = self::getValues();

        return in_array($value, $values, $strict);
    }

    /**
     * @return array
     */
    public static function getValues()
    {
        return array_values(self::getConstants());
    }

    /**
     * @return mixed
     */
    public static function getRandomValue()
    {
        $values = static::getValues();

        return self::byValue($values[array_rand($values)]);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Enum
     */
    public static function __callStatic($name, $arguments)
    {
        return self::byName($name);
    }

    /**
     * @param $equals
     * @return bool
     */
    public function equals($equals)
    {
        return $this->value == $equals;
    }

    /**
     * @return mixed
     */
    final public function __toString()
    {
        return $this->value;
    }

    /**
     * @param $trans
     * @param Closure|null $keyCb
     * @param array $values
     * @return string
     */
    public static function getDatatableString($trans, Closure $keyCb = null, $values = [])
    {
        if (empty($values)) {
            $values = static::getConstants();
        }
        $data = '';
        foreach ($values as $key) {
            $keyVal = $keyCb ? $keyCb($key) : $key;
            $data .= sprintf('%s:%s;', $keyVal, trans($trans . $key));
        }

        return substr($data, 0, -1);
    }

    /**
     * @param $trans
     * @param Closure|null $keyCb
     * @param array $values
     * @return array
     */
    public static function getSelectString($trans, Closure $keyCb = null, $values = [])
    {
        if (empty($values)) {
            $values = static::getConstants();
        }
        $data = [];
        foreach ($values as $key) {
            $keyVal = $keyCb ? $keyCb($key) : $key;
            $data[$keyVal] = trans($trans . $key);
        }

        return $data;
    }

    /**
     * @param array $equals
     * @return bool
     */
    public function any(array $equals)
    {
        return in_array($this->value, $equals);
    }
}
