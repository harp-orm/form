<?php

namespace Harp\Form\Field;

use Harp\Validate\Assert;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Input extends AbstractField
{
    public function render()
    {
        $attrs = array(
            'type' => 'text',
            'value' => $this->getValue(),
        );

        return "<input{$this->renderAttrs($attrs)}>";
    }

    public function attrsForAsserts()
    {
        $attrs = parent::attrsForAsserts();

        if (! $this->isEmptyAsserts() and $this->getHtmlValidation()) {
            foreach ($this->getAsserts() as $assert) {
                if ($assert instanceof Assert\Email) {
                    $attrs['type'] = 'email';
                } elseif ($assert instanceof Assert\URL) {
                    $attrs['type'] = 'url';
                }
            }
        }

        return $attrs;
    }
}
