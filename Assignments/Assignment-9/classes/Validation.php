<?php
class Validation {
  public function validateName($name) {
    return preg_match("/^[a-zA-Z' ]+$/", $name);
  }

  public function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  public function validatePassword($password) {
    return preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/", $password);
  }
}
