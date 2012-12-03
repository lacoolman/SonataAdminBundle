<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MinDateValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        if($value == null) {
            $this->setMessage('Введите дату');
            return false;
        }

        $currentDate = new \DateTime('now');
        $diff = $value->diff($currentDate);
        if($diff->days > 0 && $diff->invert == 0) {
            $this->setMessage($constraint->message);
            return false;
        }
        return true;
    }
}
