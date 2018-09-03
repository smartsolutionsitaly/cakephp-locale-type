<?php
/**
 * cakephp-locale-type (https://github.com/smartsolutionsitaly/cakephp-locale-type)
 * Copyright (c) 2018 Smart Solutions S.r.l. (https://smartsolutions.it)
 *
 * Locale type for CakePHP
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  cakephp-plugin
 * @package   cakephp-locale-type
 * @author    Lucio Benini <dev@smartsolutions.it>
 * @copyright 2018 Smart Solutions S.r.l. (https://smartsolutions.it)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://smartsolutions.it Smart Solutions
 * @since     1.0.0
 */

namespace SmartSolutionsItaly\CakePHP\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use Cake\Database\Type\BatchCastingInterface;
use PDO;
use SmartSolutionsItaly\CakePHP\Database\Locale;

/**
 * Locale database type.
 *
 * @package SmartSolutionsItaly\CakePHP\Database\Type
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class LocaleType extends Type implements BatchCastingInterface
{
    /**
     * {@inheritDoc}
     *
     * @see \Cake\Database\Type::marshal()
     */
    public function marshal($value)
    {
        return Locale::parse($value);
    }

    /**
     * {@inheritDoc}
     *
     * @see \Cake\Database\Type::toPHP()
     */
    public function toPHP($value, Driver $d)
    {
        return Locale::parse($value);
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function manyToPHP(array $values, array $fields, Driver $driver)
    {
        foreach ($fields as $field) {
            if (!isset($values[$field])) {
                continue;
            }

            $values[$field] = Locale::parse($values[$field]);
        }

        return $values;
    }

    /**
     * {@inheritDoc}
     *
     * @see \Cake\Database\Type::toDatabase()
     */
    public function toDatabase($value, Driver $driver)
    {
        if ($value instanceof Locale) {
            return $value->toString();
        } else {
            return $value;
        }
    }

    /**
     * {@inheritDoc}
     *
     * @see \Cake\Database\Type::toStatement()
     */
    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }

        return PDO::PARAM_STR;
    }
}
