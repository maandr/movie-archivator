<?php
class Form
{
    protected $fields;
    protected $invalidFields;
    protected $fieldFactory;

    public function __construct()
    {
        $this->fields = array();
        $this->invalidFields = array();
        $this->fieldFactory = FormFieldFactory::getInstance();
    }
    
    public function createField($type, $name, $value = null)
    {
        $this->fields[$name] = $this->fieldFactory->createField($type, $name, $value);
    }
    
    private function assignArray($arr)
    {
        foreach($arr as $key => $value)
        {
            $this->assign($key, $value);
        }
    }

    public function assign($name, $value)
    {
    	try {
	    	$field = $this->getField($name);
	    	$field->setValue($value);
    	}
    	catch(Exception $e)
    	{
    		
    	}
    }
    
    public function getData()
    {
    	$data = array();
    	
    	foreach($this->fields as $field)
    	{
    		$data[$field->getName()] = $field->getValue();
    	}
    	
    	return $data;
    }
    
    public function parse($var)
    {
    	if(!is_array($var))
    	{
    		throw new Exception("The passed value must be an array in order to parse it.");
    	}
    	
    	$this->assignArray($var);
    }
    
    public function getField($name)
    {
    	if(!key_exists($name, $this->fields))
    	{
    		throw new Exception("A field named $name does not exist.");
    	}
    	
    	if(!($this->fields[$name] instanceof IFormField))
    	{
    		throw new Exception("The field $name does not implement IFormField.");
    	}
    	
    	return $this->fields[$name];
    }
    
    public function setFieldMessage($name, $message)
    {
        $field = $this->getField($name);
        $field->setErrorMessage($message);
    }
    
    public function setFieldDescription($name, $desc)
    {
    	$field = $this->getField($name);
    	$field->setDescription($desc);
    }
    
    public function getInvalidFields()
    {
        $this->isValid();
        return $this->invalidFields;
    }
    
    public function getErrors()
    {
    	$errors = array();
    	
    	foreach($this->getInvalidFields() as $invalidField)
    	{
    		array_push($errors, $invalidField->getErrorMessage());
    	}
    	
    	return $errors;
    }
    
    public function isValid()
    {
        $this->invalidFields = array();

        foreach($this->fields as $name => $field)
        {
            if(!$field->isValid())
            {
                $this->invalidFields[$name] = $field;
            }
        }
        
        return count($this->invalidFields) == 0;
    }
    
    public function toArray()
    {
        $data = array();
        
        foreach($this->fields as $field)
        {
            $data[$field->getName()] = $field->getValue();
        }
        
        return $data;
    }
}
?>
