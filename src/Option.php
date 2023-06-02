<?php

namespace Alg {
  class Option {
    private $value;

    public function __construct($value = null) {
      $this->value = $value;
    }

    public function hasValue() {
      return isset($this->value);
    }

    public function getOrElse($defaultValue) {
      return $this->hasValue() ? $this->value : $defaultValue;
    }

    public static function some($value) {
      return new Option($value);
    }

    public static function none() {
      return new Option();
    }

    public function bind($callback) {
      return $this->hasValue()
        ? $callback($this->value)
        : $this;
    }

    public function match($someCallback, $noneCallback) {
      $this->hasValue()
        ? $someCallback($this->value)
        : $noneCallback();
    }

    public function reduce($callback, $initialValue = null) {
      $this->hasValue()
        ? $callback($initialValue, $this->value)
        : $initialValue;
    }

    public function flatten() {
      ($this->hasValue() && $this->value instanceof Option)
        ? $this->value->flatten()
        : $this;
    }
  }
}
  
?>