<?php

require 'config/config.php';
require 'config/database.php';
use Model\ActiveRecord;

$database = database();
ActiveRecord::setDB($database);
