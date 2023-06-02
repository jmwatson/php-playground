<?
class Result {
    private $value;
    private $exception;
  
    public function __construct($value = null, $exception = null) {
      if ($value !== null && $exception !== null) {
        throw new Exception("A Result instance can only contain a value or an exception, not both.");
      }
      $this->value = $value;
      $this->exception = $exception;
    }
  
    public function hasValue() {
      return $this->value !== null;
    }
  
    public static function ok($value) {
      return new Result($value);
    }
  
    public static function error($exception) {
      return new Result(null, $exception);
    }
  
    public function bind($callback) {
      return $this->hasValue()
        ? $callback($this->value)
        : $this;
    }
  
    public function match($okCallback, $errorCallback) {
      return $this->hasValue()
        ? $okCallback($this->value)
        : $errorCallback($this->exception);
    }
  
    public function reduce($callback, $initialValue = null) {
      return $this->hasValue()
        ? $callback($initialValue, $this->value)
        : $initialValue;
    }
  
    public function flatten() {
      return $this->hasValue() && $this->value instanceof Result
        ? $this->value->flatten()
        : $this;
    }
    
    public function orThrow() {
      return $this->exception ?? $this->value;
    }
  }
  
?>