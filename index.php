<?php

if(!defined('ROOT_DIR')) define('ROOT_DIR', realpath(__DIR__));

require 'vendor/autoload.php';

(\Dotenv\Dotenv::createImmutable(__DIR__))->load(); //Load .env parameters

include_once("routes/slash.route.php");

