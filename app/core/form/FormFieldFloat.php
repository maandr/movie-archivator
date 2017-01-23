<?php
class FormFieldFloat extends FormField
{
	public function isValid() { return Validator::isFloat($this->value); }
}
?>