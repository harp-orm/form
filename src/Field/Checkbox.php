<?php

namespace CL\Form\Field;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Checkbox extends AbstractField
{
    public function render()
    {
        $attrs = array(
            'type' => 'checkbox',
            'value' => 1,
        );

        if ($this->getValue()) {
            $attrs []= 'checked';
        }

        $clearAttrs = array(
            'type' => 'hidden',
            'id' => null,
            'value' => 0,
        );

        return "<input{$this->renderAttrs($clearAttrs)}><input{$this->renderAttrs($attrs)}>";
    }
}
