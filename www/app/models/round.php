<?php

class Round extends AppModel
{
	var $name = 'Round';
	var $belongsTo = array('Team', 'Project');
	var $hasAndBelongsToMany = array('Part');
}