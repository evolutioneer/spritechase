<?php 

class Project extends AppModel
{
	var $name = 'Project';
	var $hasMany = array('Round');
}