<?php

namespace CL\Form\Test;

use CL\Form\Fields;
use CL\Carpo\Asserts;
use CL\Carpo\Assert;

class FieldsTest extends AbstractTestCase
{
    public function testTest()
    {
        $subject = new \stdClass();
        $subject->title = '';
        $subject->body = 'asdfasdf';
        $subject->isBig = false;
        $subject->status = array('big', 'small');

        $fields = new Fields($subject, new Asserts([
            new Assert\Present('title'),
            new Assert\LengthGreaterThan('body', 100),
            new Assert\Email('title'),
        ]));

        $fields->validate();

        echo $fields
            ->selectMultipleRow('status', array('big' => 'Big', 'small' => 'Small', 'medium' => 'Medium'))
            ->setFieldAttrs(array('disabled'));

        echo $fields
            ->inputRow('title')
            ->setHelp('HEEELP')
            ->setLabel('LLLAAA')
            ->setFieldAttrs(array('disabled'));

        echo $fields
            ->inputRow('body');

        echo $fields
            ->checkboxRow('isBig');
    }
}
