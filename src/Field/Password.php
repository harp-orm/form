<?php

namespace CL\Form\Field;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Password extends AbstractField
{
    public function render()
    {
        $attrs = array(
            'type' => 'password',
        );

        return "<input{$this->renderAttrs($attrs)}>";
    }
}
