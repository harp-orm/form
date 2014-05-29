<?php

namespace Harp\Form;

use Harp\Validate\Errors;
use Harp\Form\Field;
use Harp\Validate\Asserts;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractFields
{
    protected $subject;
    protected $errors;
    protected $asserts;
    protected $htmlValidation = true;
    protected $prefix = "%s";


    function __construct($subject = null, Asserts $asserts = null) {
        $this->subject = $subject;
        $this->asserts = $asserts;
    }

    public function validate()
    {
        $this->errors = $this->asserts->validate($this->subject);

        return $this;
    }

    public function setHtmlValidation($value)
    {
        $this->htmlValidation = (bool) $value;

        return $this;
    }

    public function getHtmlValidation()
    {
        return $this->htmlValidation;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = (string) $prefix;

        return $this;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }


    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors(Errors $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    public function getAsserts()
    {
        return $this->asserts;
    }

    public function setAsserts(Asserts $asserts)
    {
        $this->asserts = $asserts;

        return $this;
    }

    public function isEmptyAsserts()
    {
        return (! $this->asserts or $this->asserts->isEmpty());
    }

    public function getValue($name)
    {
        if (is_object($this->subject)) {
            return isset($this->subject->{$name}) ? $this->subject->{$name} : null;
        } else {
            return isset($this->subject[$name]) ? $this->subject[$name] : null;
        }
    }

    public function row(Field\AbstractField $field)
    {
        $label = Inflector::title($field->getName());
        $row = new Row($field, $label);

        if ($this->errors !== null) {
            $row->setErrors($this->errors->onlyFor($field->getName()));
        }

        return $row;
    }
}
