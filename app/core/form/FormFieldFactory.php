<?php
class FormFieldFactory
{
	private static $instance = null;
	
	private function __construct()
	{
	}
	
	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new FormFieldFactory();
		}
		return self::$instance;
	}
	
	public function createField($fieldType, $name, $value = null)
	{
		switch($fieldType)
		{
			case FieldType::Optional:
				return new FormFieldOptional($name, $value);
				break;
			case FieldType::String:
				return new FormFieldString($name, $value);
				break;
			case FieldType::Integer:
				return new FormFieldInteger($name, $value);
				break;
			case FieldType::Email:
				return new FormFieldEmail($name, $value);
				break;
			case FieldType::Float:
				return new FormFieldFloat($name, $value);
				break;
			case FieldType::Boolean:
				return new FormFieldBoolean($name, $value);
				break;
			case FieldType::IP:
				return new FormFieldIp($name, $value);
				break;
			case FieldType::MAC:
				return new FormFieldMac($name, $value);
				break;
			case FieldType::Url:
				return new FormFieldUrl($name, $value);
				break;
			case FieldType::Encrypted:
				return new FormFieldEncrypted($name, $value);
				break;
			default:
				throw new Exception("A field of the type $fieldType does not exist.");
				break;
		}
	}
}
?>