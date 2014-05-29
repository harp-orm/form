<?php

namespace Harp\Form\Test;

use Harp\Form\Fields;
use Harp\Validate\Asserts;
use Harp\Validate\Assert;

class FieldsTest extends AbstractTestCase
{
    public function testTest()
    {
        $subject = new \stdClass();
        $subject->title = 'test';
        $subject->title_confirm = 'test2';
        $subject->body = 'asdfasdf';
        $subject->isBig = false;
        $subject->status = array('big', 'small');

        $fields = new Fields($subject, new Asserts([
            new Assert\Present('title'),
            new Assert\LengthGreaterThan('body', 100),
            new Assert\Email('title'),
            new Assert\Matches('title', 'title_confirm'),
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
