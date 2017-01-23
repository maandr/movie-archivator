<?php
class FormFieldUrl extends FormField
{
	public function isValid() { return Validator::isUrl($this->value); }
}
?>