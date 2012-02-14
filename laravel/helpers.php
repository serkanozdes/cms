<?php

/**
 * Convert HTML characters to entities.
 *
 * The encoding specified in the application configuration file will be used.
 *
 * @param  string  $value
 * @return string
 */
function e ($value)
{
    return Laravel\HTML::entities($value);
}

/**
 * Retrieve a language line.
 *
 * @param $key string           
 * @param $replacements array           
 * @param $language string           
 * @return string
 */
function __ ($key, $replacements = array(), $language = null)
{
    return Laravel\Lang::line($key, $replacements, $language);
}