<?php

class ConfigurationManager
{
    public static function get_db_configuration($db_driver)
    {
        $db_configuration_file = require "db-config.php";

        if (!isset($db_configuration_file[$db_driver])) {
            throw new Error("No configuration for $db_driver");
        }

        $db_configuration = $db_configuration_file[$db_driver];

        return $db_configuration;
    }
}
