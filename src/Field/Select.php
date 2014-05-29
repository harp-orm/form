<?php

namespace Harp\Form\Field;

use Harp\Form\Fields;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Select extends AbstractField
{
    protected $options;

    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function __construct($name, array $options, Fields $fields = null)
    {
        parent::__construct($name, $fields);

        $this->options = $options;
    }

    public function isSelected($key)
    {
        return $key == $this->getValue();
    }

    public function renderOptions()
    {
        $html = '';

        foreach ($this->options as $key => $value) {
            $selected = $this->isSelected($key) ? ' selected' : null;

            $html .= "<options value=\"{$key}\"{$selected}>{$value}</options>";
        }

        return $html;
    }

    public function render()
    {
        return "<select{$this->renderAttrs()}>{$this->renderOptions()}</select>";
    }
}
