<?php

namespace Harp\Form;

use Harp\Validate\Errors;
use Harp\Form\Field\AbstractField;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Row
{
    protected $help;
    protected $label;
    protected $errors;
    protected $class;

    function __construct(AbstractField $field, $label)
    {
        $this->field = $field;
        $this->class = 'form-row';
        $this->label = $label;
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

    public function isEmptyErrors()
    {
        return ($this->errors and $this->errors->isEmpty());
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = (string) $label;

        return $this;
    }

    public function getHelp()
    {
        return $this->help;
    }

    public function setHelp($help)
    {
        $this->help = (string) $help;

        return $this;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setClass($class)
    {
        $this->class = (string) $class;

        return $this;
    }

    public function getFieldAttrs()
    {
        return $this->field->getAttrs();
    }

    public function setFieldAttrs(array $attrs)
    {
        $this->field->setAttrs($attrs);

        return $this;
    }

    public function getFieldName()
    {
        return $this->field->getName();
    }

    public function setFieldName($name)
    {
        $this->field->setName($name);

        return $this;
    }

    public function getFieldPrefix()
    {
        return $this->field->getPrefix();
    }

    public function setFieldPrefix($name)
    {
        $this->field->setPrefix($name);

        return $this;
    }

    public function getFieldValue()
    {
        return $this->field->getValue();
    }

    public function setFieldValue($name)
    {
        $this->field->setValue($name);

        return $this;
    }

    public function getFieldHtmlValidation()
    {
        return $this->field->getHtmlValidation();
    }

    public function setFieldHtmlValidation($name)
    {
        $this->field->setHtmlValidation($name);

        return $this;
    }

    public function renderClass()
    {
        return $this->class.($this->isEmptyErrors() ? null : ' form-row-with-errors');
    }

    public function renderLabel()
    {
        if ($this->label) {
            $for = $this->field->getAttr('id');

            return "<label class=\"form-row-label\" for=\"{$for}\">{$this->label}</label>";
        }
    }

    public function renderField()
    {
        return "<div class=\"form-row-field\">{$this->field}</div>";
    }

    public function renderErrors()
    {
        if (! $this->isEmptyErrors()) {
            return "<div class=\"form-row-errors\">{$this->errors}</div>";
        }
    }

    public function renderHelp()
    {
        if ($this->help) {
            return "<div class=\"form-row-help\">{$this->help}</div>";
        }
    }

    public function render()
    {
        $template = <<<TEMPLATE

<div class=":class">
    :label
    :field
    :errors
    :help
</div>

TEMPLATE;

        $params = array(
            ':class' => $this->renderClass(),
            ':label' => $this->renderLabel(),
            ':errors' => $this->renderErrors(),
            ':field' => $this->renderField(),
            ':help' => $this->renderHelp(),
        );

        return strtr($template, $params);
    }

    public function __toString()
    {
        return $this->render();
    }
}
