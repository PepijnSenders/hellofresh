<?php

namespace Pep\Validation;

class Validator {

  public static function validateEmail($attribute, $value) {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      throw new ValidationException("Invalid email: $attribute.");
    }
  }

  public static function validateRequired($attribute, $value) {
    if (empty($value)) {
      throw new ValidationException("$attribute is required.");
    }
  }

  public static function validateEquals($attribute, $equalsAttribute, $value, $equalsValue) {
    if ($value !== $equalsValue) {
      throw new ValidationException("$attribute is not equal to $equalsAttribute.");
    }
  }

}