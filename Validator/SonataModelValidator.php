<?php
namespace Sonata\AdminBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SonataModelValidator  extends ConstraintValidator{

    public function isValid($value, Constraint $constraint)
    {
       $array =  $value->toArray();
       if(!isset($array) || empty($array)) {
           //die();
           $this->setMessage($constraint->message);
           return false;
       }

        return true;
    }
}
