<?php

namespace CL\Form\Field;

use CL\Carpo\Asserts;
use CL\Carpo\Assert;
use CL\Form\Fields;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractField
{
    protected $prefix;
    protected $name;
    protected $value;
    protected $fields;
    protected $attrs = array();
    protected $asserts;
    protected $htmlValidation = true;

    public function __construct($name, Fields $fields = null)
    {
        $this->name = $name;

        if ($fields) {
            $this->fields = $fields;
            $this->htmlValidation = $fields->getHtmlValidation();
            $this->prefix = $fields->getPrefix();
            $this->value  = $fields->getValue($this->name);

            if (! $fields->isEmptyAsserts()) {
                $this->asserts = $fields->getAsserts()->onlyFor($this->name);
            }
        }

        $this->attrs = array(
            'name' => $this->renderName(),
            'id' => $this->renderId(),
        );
    }

    public function setFields(Fields $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function getFields()
    {
        return $this->fields;
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

    public function setAttrs($attrs)
    {
        $this->attrs += $attrs;

        return $this;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }

    public function getAttr($name)
    {
        return isset($this->attrs[$name]) ? $this->attrs[$name] : null;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = (string) $prefix;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = (string) $value;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string) $name;

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
        return ($this->asserts and $this->asserts->isEmpty());
    }

    public function attrsForAsserts()
    {
        $attrs = array();

        if (! $this->isEmptyAsserts() and $this->htmlValidation) {

            foreach ($this->asserts as $assert) {
                if ($assert instanceof Assert\Present) {
                    $attrs []= 'required';

                } elseif ($assert instanceof Assert\LengthEquals) {
                    $attrs['pattern'] = ".{{$assert->getLength()}}";

                } elseif ($assert instanceof Assert\LengthGreaterThan) {
                    $attrs['pattern'] = ".{{$assert->getLength()},}";

                } elseif ($assert instanceof Assert\LengthLessThan) {
                    $attrs['pattern'] = ".{,{$assert->getLength()}}";

                } elseif ($assert instanceof Assert\LengthBetween) {
                    $attrs['pattern'] = ".{{$assert->getMin()},{$assert->getMax()}}";

                } elseif ($assert instanceof Assert\RegEx) {
                    $attrs['pattern'] = $assert->getPattern();
                }
            }
        }

        return $attrs;
    }

    public function renderAttrs(array $additional = array())
    {
        $html = '';

        $attrs = array_merge($this->attrsForAsserts(), $this->attrs, $additional);

        foreach ($attrs as $name => $value)
        {
            if ($value !== null) {
                $value = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');

                $html .= is_numeric($name) ? ' '.$value : " {$name}=\"$value\"";
            }
        }

        return $html;
    }

    public function renderName()
    {
        return sprintf($this->prefix, $this->name);
    }

    public function renderId()
    {
        return str_replace(array('[', ']'), array('_', ''), $this->renderName());
    }

    public function __toString()
    {
        return $this->render();
    }

    abstract public function render();
}
