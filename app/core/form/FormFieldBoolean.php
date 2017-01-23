<?php
class Boolean extends FormField
{
	public function isValid() { return Validator::isBoolean($this->value); }
}
?>