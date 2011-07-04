<?php

class Round extends AppModel
{
	var $name = 'Round';
	var $hasAndBelongsToMany = array('Part');
}