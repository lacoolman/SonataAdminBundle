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
        $diffCurrent = $value->diff($currentDate);
        if(isset($constraint->oldDate)) {
            $diffEntered = $value->diff($constraint->oldDate);
            if(($diffEntered->days > 0 && $diffEntered->invert == 0) && ($diffCurrent->days > 0 && $diffCurrent->invert == 0)) {
                $message = $constraint->message;
                if(!isset($message)) $message = 'Дата не может быть меньше ранее установленной';
                    $this->setMessage($constraint->message, array('{{ value }}' => $value));
                    return false;
            }
        } else {
            if($diffCurrent->days > 0 && $diffCurrent->invert == 0) {
                $this->setMessage($constraint->message);
                return false;
            }
        }

        return true;
    }
}
