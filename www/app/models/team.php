<?php

/**
 * id - auto incremented id
 * name - name of the team for display
 * time_start - when the team began its run
 * time_stop - when the team's run ended (either the max time if their time runs out, or the time they report)
 * 
 * //$$todo create a hasMany relationship with Users
 * 
 * @author ross
 */
class Team extends AppModel
{
	var $name = 'Team';
}