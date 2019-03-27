<?php

class AppValidator
{
    private static $config;
    private static $error;

    public static function setConfig ($config)
    {
        AppValidator::$config = $config;
    }
    public static function setValidation ($validationId, $data)
    {
        $result = [];
        AppValidator::$error = [];

        if (is_array($data) && !empty($data) && isset(AppValidator::$config[$validationId]) ) {
            
            $validation = AppValidator::$config[$validationId];
            $result = AppValidator::validate($validation, 'required', $data);

            if (isset($validation['optional'])) {
                $result = array_merge($result, AppValidator::validate($validation, 'optional', $data));
            }
        }

        return $result;
    }

    public static function isValid ()
    {
        return (empty(AppValidator::$error)) ? true : false;
    }

    public static function getError ()
    {
        return AppValidator::$error;
    }

    private static function validate ($validation, $validationId, $data)
    {
        $result = [];

        foreach($validation[$validationId] as $key) {

            if (isset($data[$key]) && trim($data[$key]) !== '') {

                $result[$key] = trim($data[$key]);

            } else {
                if ($validationId === 'required') {
                    AppValidator::$error[] = $key;
                }
            }
        }

        return $result;
    }
}