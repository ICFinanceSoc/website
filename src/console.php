#!/usr/bin/env php
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 04/01/2013
 * Time: 02:36
 * To change this template use File | Settings | File Templates.
 */

date_default_timezone_set("GMT");

require_once 'bootstrap.php';

$console = new ICFS\Console();

$console->setContainer($app);

$console->run();