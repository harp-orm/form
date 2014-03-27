<?php

namespace CL\Form\Field;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Radio extends AbstractField
{
    public function render()
    {
        $attrs = array(
            'type' => 'radio',
            'value' => 1,
        );

        if ($this->getValue()) {
            $attrs []= 'checked';
        }

        return "<input{$this->renderAttrs($attrs)}>";
    }
}
