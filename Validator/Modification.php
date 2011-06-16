<?php
namespace CSF\CartBundle\Validator;

class Modification
{
	public static $message = 'La valeur doit être comprise entre 1 et 999';

	public static function testValeur($value)
	{
		if(!is_numeric($value) || $value <= 0){
			return false;
		}
		return true;
	}
}