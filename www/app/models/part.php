<?php

class Part extends AppModel
{
	var $name = 'Part';
	var $hasAndBelongsToMany = array(
		'Project',
		'Round',
		'User'
	);
}