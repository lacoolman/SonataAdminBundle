<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;

class SonataModel extends Constraint{
    public $message = 'Должна быть выбрана группа';

}
