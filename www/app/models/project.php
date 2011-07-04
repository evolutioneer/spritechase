<?php 

class Project extends AppModel
{
	var $name = 'Project';
	var $hasAndBelongsToMany = array('Part');
}