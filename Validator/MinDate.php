<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;
class MinDate extends Constraint
{
    public $message = "Дата не может быть меньше текущей";
    public $oldDate;
    public $required = true;
}
