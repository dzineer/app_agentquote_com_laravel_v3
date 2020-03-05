<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 9/26/18
 * Time: 2:58 PM
 */

	if(!function_exists('format_phone'))
	{
		function format_phone($value)
		{
			if ($numbers_only = preg_replace("/[^\d]/", "", $value))
			{
				return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
			}
			else if (preg_match('/^\+\d(\d{3})(\d{3})(\d{4})$/', $value, $matches))
			{
				return $matches[1] . '-' . $matches[2] . '-' . $matches[3];
			}
			else
			{
				return $value;
			}
		}
	}

	if(!function_exists('format_field'))
	{
		function format_field($type, $value)
		{
			switch ($type)
			{
				case 'phone':
					return format_phone($value);

				default:
					return $value;
			}
		}
	}
