<?php

if (!function_exists('karavel_database_reset')) {
    function karavel_database_reset()
    {
        box('spec')->get('testCase')->databaseReset();
    }
}

if (!function_exists('karavel_database_migrate')) {
    function karavel_database_migrate()
    {
        box('spec')->get('testCase')->databaseMigrate();
    }
}

if (!function_exists('karavel_database_rollback')) {
    function karavel_database_rollback()
    {
        box('spec')->get('testCase')->databaseRollback();
    }
}

if (!function_exists('karavel_database_reset')) {
    function karavel_database_rollback()
    {
        box('spec')->get('testCase')->databaseReset();
    }
}

