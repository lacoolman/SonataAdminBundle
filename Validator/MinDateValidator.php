<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MinDateValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        if($value == null AND $constraint->required) {
            $this->setMessage('Введите дату');
            return false;
        }


        if(!empty($value))
        {
            if(isset($constraint->oldDate)) {
                $diffEntered = $value->diff($constraint->oldDate);
                if($diffEntered->days > 0 && $diffEntered->invert == 0) {
                    $message = (isset($constraint->message)) ? $constraint->message : 'Дата не может быть меньше ранее установленной';
                    $this->setMessage($message, array('{{ value }}' => $value->format('d.m.Y')));
                    return false;
                }
            } else {
                $currentDate = new \DateTime('now');
                $diffCurrent = $value->diff($currentDate);

                if($diffCurrent->days > 0 && $diffCurrent->invert == 0) {
                    $this->setMessage($constraint->message);
                    return false;
                }
            }
        }
        return true;
    }
}
