<?php

class Part extends AppModel
{
	var $name = 'Part';
	var $hasAndBelongsToMany = array('User', 'Round', 'Project');
}