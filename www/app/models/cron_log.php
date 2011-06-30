<?php

class CronLog extends AppModel
{
	var $name = 'CronLog';
	var $belongsTo = array('Cron');
}