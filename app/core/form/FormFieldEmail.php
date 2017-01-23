<?php
class FormFieldEmail extends FormField
{
	public function isValid() { return Validator::isEmail($this->value); }
}
?>