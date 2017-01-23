<?php
interface IFormField
{
	function getName();
	
	function setValue($value);
	function getValue();
	
	function setDescription($value);
	function getDescription();
	
	function isValid();
	
	function setErrorMessage($value);
	function getErrorMessage();
}
?>