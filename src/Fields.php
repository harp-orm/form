<?php

namespace Harp\Form;

use Harp\Form\Field;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Fields extends AbstractFields
{
    public function checkbox($name)
    {
        return new Field\Checkbox($name, $this);
    }

    public function checkboxRow($name)
    {
        $field = $this->checkbox($name);

        return $this->row($field);
    }

    public function file($name)
    {
        return new Field\File($name, $this);
    }

    public function fileRow($name)
    {
        $field = $this->file($name);

        return $this->row($field);
    }

    public function hidden($name)
    {
        return new Field\Hidden($name, $this);
    }

    public function hiddenRow($name)
    {
        $field = $this->hidden($name);

        return $this->row($field);
    }

    public function input($name)
    {
        return new Field\Input($name, $this);
    }

    public function inputRow($name)
    {
        $field = $this->input($name);

        return $this->row($field);
    }

    public function password($name)
    {
        return new Field\Password($name, $this);
    }

    public function passwordRow($name)
    {
        $field = $this->password($name);

        return $this->row($field);
    }

    public function radio($name)
    {
        return new Field\Radio($name, $this);
    }

    public function radioRow($name)
    {
        $field = $this->radio($name);

        return $this->row($field);
    }

    public function select($name, array $options)
    {
        return new Field\Select($name, $options, $this);
    }

    public function selectRow($name, array $options)
    {
        $field = $this->select($name, $options);

        return $this->row($field);
    }

    public function selectMultiple($name, array $options)
    {
        return new Field\SelectMultiple($name, $options, $this);
    }

    public function selectMultipleRow($name, array $options)
    {
        $field = $this->selectMultiple($name, $options);

        return $this->row($field);
    }

    public function textarea($name)
    {
        return new Field\Textarea($name, $this);
    }

    public function textareaRow($name)
    {
        $field = $this->textarea($name);

        return $this->row($field);
    }
}
