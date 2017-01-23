<?php
class FormFieldEncrypted implements IFormField
{
    protected $name;
    protected $value;
    protected $description;
    protected $errorMessage;

    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }
    
    public function getName() { return $this->name; }
    
    public function setValue($value) { $this->value = $value; }
    public function getValue() { return Hash::create($this->value); }
    
    public function setDescription($value) { $this->description = $value; }
    public function getDescription() { return $this->description; }
    
    public function setErrorMessage($value) { $this->errorMessage = $value; }
    public function getErrorMessage() { return $this->errorMessage; }
    
	public function isValid() { return !Validator::isBlank($this->value); }
}
?>