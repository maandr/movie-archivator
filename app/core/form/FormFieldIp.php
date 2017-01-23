<?php
class FormFieldIp extends FormField
{
	public function isValid() { return Validator::isIP($this->value); }
}
?>