<?php

class Validator
{
    private static $config;
    private static $error;

    public static function setConfig ($config)
    {
        Validator::$config = $config;
    }
    public static function setValidation ($validationId, $data)
    {
        $result = [];
        Validator::$error = [];

        if (is_array($data) && !empty($data) && isset(Validator::$config[$validationId]) ) {
            
            $validation = Validator::$config[$validationId];
            $result = Validator::validate($validation, 'required', $data);

            if (isset($validation['optional'])) {
                $result = array_merge($result, Validator::validate($validation, 'optional', $data));
            }
        }

        return $result;
    }

    public static function isValid ()
    {
        return (empty(Validator::$error)) ? true : false;
    }

    public static function getError ()
    {
        return Validator::$error;
    }

    private static function validate ($validation, $validationId, $data)
    {
        $result = [];

        foreach($validation[$validationId] as $key) {

            if (isset($data[$key]) && trim($data[$key]) !== '') {

                $result[$key] = trim($data[$key]);

            } else {
                if ($validationId === 'required') {
                    Validator::$error[] = $key;
                }
            }
        }

        return $result;
    }
}