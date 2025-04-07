<?php
class StickyForm {
  public function validateForm($post) {
    $valid = new Validation();
    $elements = $post;
    $elements['firstNameError'] = $elements['lastNameError'] = $elements['emailError'] = '';
    $elements['passwordError'] = $elements['confirmPasswordError'] = '';
    $elements['formMsg'] = 'valid';

    if (!$valid->validateName($post['firstName'])) {
      $elements['firstNameError'] = "Only letters, spaces, and apostrophes allowed";
      $elements['formMsg'] = '';
    }
    if (!$valid->validateName($post['lastName'])) {
      $elements['lastNameError'] = "Only letters, spaces, and apostrophes allowed";
      $elements['formMsg'] = '';
    }
    if (!$valid->validateEmail($post['email'])) {
      $elements['emailError'] = "Invalid email format";
      $elements['formMsg'] = '';
    }
    if (!$valid->validatePassword($post['password'])) {
      $elements['passwordError'] = "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)";
      $elements['formMsg'] = '';
    } elseif ($post['password'] !== $post['confirmPassword']) {
      $elements['confirmPasswordError'] = "Your passwords do not match";
      $elements['formMsg'] = '';
    }

    return $elements;
  }
}
