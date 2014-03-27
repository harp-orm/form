<?php

namespace CL\Form\Field;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class SelectMultiple extends Select
{
    public function isSelected($key)
    {
        return in_array($key, (array) $this->getValue());
    }

    public function render()
    {
        $attrs = array('multiple');

        return "<select{$this->renderAttrs($attrs)}>{$this->renderOptions()}</select>";
    }
}
