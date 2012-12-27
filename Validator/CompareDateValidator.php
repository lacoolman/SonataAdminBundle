<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CompareDateValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        if($value == null || empty($constraint->endDate)) {
            $this->setMessage('Введите дату');
            return false;
        }
        return $value->diff($constraint->endDate)->invert == 0;
    }
}
