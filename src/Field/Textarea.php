<?php

namespace CL\Form\Field;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Textarea extends AbstractField
{
    public function render()
    {
        $attrs = array(
            'type' => 'text',
            'value' => $this->getValue(),
        );

        return "<textarea{$this->renderAttrs($attrs)}>{$this->getValue()}</textarea>";
    }
}
