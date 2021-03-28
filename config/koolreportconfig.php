<?php


$connection = array(
    "connectionString" => "mysql:host=localhost;dbname=eat_me",
    "username" => "eatme",
    "password" => "weM2KxUZriR9",
    "charset" => "utf8"
);

//Koolreport config
use \koolreport\datasources\PdoDataSource;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\BarChart;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\google\LineChart;
