<?php
class FormFieldInteger extends FormField
{
	public function isValid() { return Validator::isInteger($this->value); }
}
?>