<?php
class FormFieldString extends FormField
{
	public function isValid() { return !Validator::isBlank($this->value); }
}
?>