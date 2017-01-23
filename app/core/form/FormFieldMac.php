<?php
class FormFieldMac extends FormField
{
	public function isValid() { return Validator::isMAC($this->value); }
}
?>