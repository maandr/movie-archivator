<?php
class Boolean extends FormField {
	public function isValid() { return Validator::isBoolean($this->value); }
}

class FormFieldEmail extends FormField {
	public function isValid() { return Validator::isEmail($this->value); }
}

class FormFieldFloat extends FormField {
	public function isValid() { return Validator::isFloat($this->value); }
}

class FormFieldInteger extends FormField {
	public function isValid() { return Validator::isInteger($this->value); }
}

class FormFieldIp extends FormField {
	public function isValid() { return Validator::isIP($this->value); }
}

class FormFieldMac extends FormField {
	public function isValid() { return Validator::isMAC($this->value); }
}

class FormFieldString extends FormField {
	public function isValid() { return !Validator::isBlank($this->value); }
}

class FormFieldUrl extends FormField {
	public function isValid() { return Validator::isUrl($this->value); }
}

class FormFieldOptional extends FormField {
	public function isValid() { return true; }
}
?>
