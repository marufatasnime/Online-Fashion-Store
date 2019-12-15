<?php

class Validators {
  private $variable_name;
  private $is_validated = true;
  public $error_messages = [];
  public $validated_data = [];
  

  public function validate($validation_rules) {
    foreach ($validation_rules as $variable_name => $validators) {
      $this->variable_name = $variable_name;
      $this->error_messages[$this->variable_name] = [];
      foreach ($validators as $validator => $conditions) {
        if (is_numeric($validator))
          $this->is_validated = (call_user_func_array([$this, $conditions], []) and $this->is_validated);
        else
          $this->is_validated = (call_user_func_array([$this, $validator], $conditions) and $this->is_validated);
      }
    }
    if (!$this->is_validated) {
      $this->validated_data = Null;
    }
    return $this->is_validated;
  }

  public function length($min=Null, $max=Null) {
    if ($min !== Null) {
      $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
      if(strlen($value) < $min) {
        $message = "Field cannot be less than {$min} characters";
        array_push($this->error_messages[$this->variable_name], $message);
        return false;
      } else {
        if(!isset($this->validated_data[$this->variable_name]))
          $this->validated_data[$this->variable_name] = $value;
        return true;
      }
    }
    if ($max !== Null) {
      $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
      if (strlen($value) > $max) {
        $message = "Field cannot be larger than {$max} characters";
        array_push($this->error_messages[$this->variable_name], $message);
        return false;
      } else {
        if(!isset($this->validated_data[$this->variable_name]))
          $this->validated_data[$this->variable_name] = $value;
        return true;
      }
    }
  }

  public function required() {
    $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
    if (strlen($value) < 1) {
      $message = "Field cannot be EMPTY";
      array_push($this->error_messages[$this->variable_name], $message);
      return false;
    } else {
      if(!isset($this->validated_data[$this->variable_name]))
        $this->validated_data[$this->variable_name] = $value;
      return true;
    }
  }

  public function numeric() {
    $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
    if (!is_numeric($value)) {
      $message = "Field has to be numbers ONLY";
      array_push($this->error_messages[$this->variable_name], $message);
      return false;
    } else {
      if(!isset($this->validated_data[$this->variable_name]))
        $this->validated_data[$this->variable_name] = $value;
      return true;
    }
  }

  public function not_numeric() {
    $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
    if (is_numeric($value)) {
      $message = "Field cannot be numbers ONLY";
      array_push($this->error_messages[$this->variable_name], $message);
      return false;
    } else {
      if(!isset($this->validated_data[$this->variable_name]))
        $this->validated_data[$this->variable_name] = $value;
      return true;
    }
  }

  public function email() {
    $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $message = "Invalid Email address";
      array_push($this->error_messages[$this->variable_name], $message);
      return false;
    } else {
      if(!isset($this->validated_data[$this->variable_name]))
        $this->validated_data[$this->variable_name] = $value;
      return true;
    }
  }

  public function match_with($target) {
    $value = filter_var($_POST[$this->variable_name], FILTER_SANITIZE_STRING);
    $target_value = filter_var($_POST[$target], FILTER_SANITIZE_STRING);
    if (!($value == $target_value)) {
      $message = "Field doesnot match with the confirmation field";
      array_push($this->error_messages[$this->variable_name], $message);
      return false;
    } else {
      if(!isset($this->validated_data[$this->variable_name]))
        $this->validated_data[$this->variable_name] = $value;
      return true;
    }
  }
}