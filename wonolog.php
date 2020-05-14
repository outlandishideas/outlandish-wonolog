<?php

/**
 * Plugin Name: Outlandish Wonolog Plugin
 * Plugin URI: https://outlandish.com/
 * Description: Integrates Wonolog with WordPress using common settings
 * Version: 0.1.1
 * Author: Outlandish
 * Author URI: https://outlandish.com/
 * License: MIT License
 */

use Inpsyde\Wonolog;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Logger;
use Outlandish\Wonolog\Handler\WordpressMailerHandler;

if ( !defined( 'Inpsyde\Wonolog\LOG' ) ) {
    return;
}

$email = new WordpressMailerHandler("matt@outlandish.com", "Wonolog Logs", Logger::INFO);
$email->setContentType('text/html')->setFormatter(new \Monolog\Formatter\HtmlFormatter());

$fingers = new FingersCrossedHandler(
    $email,
    new ErrorLevelActivationStrategy(Logger::ERROR),
    10,
    true,
    true,
    Logger::WARNING
);



$wonolog_controller = Wonolog\bootstrap();
$wonolog_controller->use_handler($fingers);
