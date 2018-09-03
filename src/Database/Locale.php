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

namespace SmartSolutionsItaly\CakePHP\Database;

/**
 * Class Locale
 *
 * @package SmartSolutionsItaly\CakePHP\Database
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class Locale implements \JsonSerializable
{
    protected $_language = null;

    protected $_culture = null;

    /**
     * Locale constructor.
     * @param null $language Language
     * @param null $culture Culture
     */
    public function __construct($language = null, $culture = null)
    {
        $this->_language = strtolower($language);
        $this->_culture = strtoupper($culture);
    }

    /**
     * Parses a value and returns its Locale representation.
     *
     * @param $value The value to parse
     * @return null|Locale The Locale representation of the given value or a null value.
     */
    public static function parse($value)
    {
        if (is_array($value)) {
            return static::fromArray((array)$value);
        } elseif (is_string($value)) {
            return static::fromString((string)$value);
        } else {
            return null;
        }
    }

    /**
     * Parses the given array and returns its Locale representation.
     *
     * @param array $value The value to parse.
     * @return Locale The Locale representation of the given value or a null value.
     */
    public static function fromArray(array $value)
    {
        $language = null;
        $culture = null;

        if (!empty($value['language'])) {
            $language = $value['language'];
        } elseif ($value[0]) {
            $language = $value[0];
        }

        if (!empty($value['culture'])) {
            $culture = $value['culture'];
        } elseif ($value[1]) {
            $culture = $value[1];
        }

        return new static($language, $culture);
    }

    /**
     * Parses the given string and returns its Locale representation.
     *
     * @param string $value The value to parse.
     * @return Locale The Locale representation of the given value or a null value.
     */
    public static function fromString(string $value)
    {
        $locale = preg_split('/-|_/', $value, 2);
        $language = null;
        $culture = null;

        if (isset($locale[0])) {
            $language = $locale[0];
        }

        if (isset($locale[1])) {
            $culture = $locale[1];
        }

        return new static($language, $culture);
    }

    /**
     * Gets the language of the current object.
     *
     * @return null|string The language of the current object.
     */
    public function getLanguage()
    {
        return $this->_language;
    }

    /**
     * Sets the language of the current object.
     *
     * @param string $value The new value for the locale's language.
     * @return Locale The current object.
     */
    public function setLanguage(string $value)
    {
        $this->_language = strtolower($value);
        return $this;
    }

    /**
     * Gets the culture of the current object.
     *
     * @return null|string The culture of the current object.
     */
    public function getCulture()
    {
        return $this->_culture;
    }

    /**
     * Sets the culture of the current object.
     *
     * @param string $value The new value for the locale's culture.
     * @return Locale The current object.
     */
    public function setCulture(string $value)
    {
        $this->_culture = strtoupper($value);
        return $this;
    }

    /**
     * Convert the current Locale to its array representation.
     *
     * @return array An array representation of the current Locale object.
     */
    public function toArray()
    {
        return [
            'language' => $this->_language,
            'culture' => $this->_culture
        ];
    }

    /**
     * Convert the current Locale to its string representation.
     *
     * @return string A string representation of the current Locale object.
     */
    public function toString()
    {
        if ($this->_language && $this->_culture) {
            return (string)$this->_language . '_' . (string)$this->_culture;
        } else {
            return (string)$this->_language;
        }
    }

    /**
     * Convert the current Locale to its string representation.
     *
     * @return string A string representation of the current Locale object.
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode function.
     *
     * @return array Returns data which can be serialized by json_encode function, which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
