<?php

namespace CL\Form;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Inflector
{
    /**
     * Makes an underscored or dashed phrase human-readable.
     *
     *     $str = Inflector::humanize('kittens-are-cats'); // "kittens are cats"
     *     $str = Inflector::humanize('dogs_as_well');     // "dogs as well"
     *
     * @param  string $str phrase to make human-readable
     * @return string
     */
    public static function humanize($str)
    {
        return preg_replace('/[_-]+/', ' ', trim($str));
    }

    /**
     * @param  string $str
     * @return string
     */
    public static function title($str)
    {
        return ucwords(self::humanize($str));
    }
}
