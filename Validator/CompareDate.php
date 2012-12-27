<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;
class CompareDate extends Constraint
{
    public $message = "Дата конца не может быть раньше даты начала";
    public $endDate;
}