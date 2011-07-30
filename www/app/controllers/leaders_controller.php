<?php

class LeadersController extends AppController
{
	var $name = 'Leaders';
	//var $uses = array('Leader', 'Cron', 'CronLog', 'Message', 'SocialShare');	
	var $uses = array('Leader');
	/**
	 * Show a view of all combined leaderboards
	 */
	function index()
	{
		
	}
	
	/**
	 * Run a cron to update the leaderboards and dispatch messages accordingly.
	 * 
	 * If the cron in the Cron table at the given ID has been run more frequently
	 * than its row in the database indicates (say every 15 minutes) ignore it.
	 */
	function cron()
	{
		if($this->Auth->user('role') != 'admin') $this->redirect('/leaders');
		
	//Determine the id of our next batch
		$batch = date('Y-m-d H:i:s');
		
		$userTotalsAndTimes = $this->Leader->query(
			'SELECT User.id, User.name, COUNT(PartUser.part_id) as part_ct, ' .
			'MIN(PartUser.dt_found) as min_dt_found, MAX(PartUser.dt_found) as max_dt_found ' .
			'FROM users User INNER JOIN parts_users PartUser ON User.id = PartUser.user_id ' .
			'WHERE User.role = "user" ' .
			'GROUP BY User.id ' .
			'ORDER BY part_ct DESC'
		);
		
		//populate these users into the leaders table
		for($i = 0; $i < count($userTotalsAndTimes) && $i < 10; $i++)
		{
			$this->Leader->create();
			
			$duration = date_diff(new DateTime($userTotalsAndTimes[$i][0]['max_dt_found']), 
				new DateTime($userTotalsAndTimes[$i][0]['min_dt_found']));
			
			$leader = array('Leader' => array(
				'rank' => $i + 1,
				'user_id' => $userTotalsAndTimes[$i]['User']['id'],
				'user_name' => $userTotalsAndTimes[$i]['User']['name'],
				'score' => $userTotalsAndTimes[$i][0]['part_ct'],
				'duration' => $duration->format('%d days, %h hours, %i minutes, %s seconds'),
				'dt_entered' => $batch
			));
			
			$this->Leader->save($leader);
		}
	
		//populate the team leaders into the leaders table
		$teamTotalsAndTimes = $this->Leader->query('SELECT Team.id, Team.name, ' .
			'COUNT(DISTINCT Round.project_id) AS project_ct, ' .
			'MIN(Round.dt_started) AS min_dt_started, ' .
			'MAX(Round.dt_completed) AS max_dt_completed ' .
			'FROM teams Team INNER JOIN rounds Round ON Team.id = Round.team_id ' .
			'WHERE Round.dt_completed > 0 AND ' .
			'Round.dt_canceled = 0 ' .
			'GROUP BY Team.id ' .
			'ORDER BY project_ct DESC'
		);
		
		for($i = 0; $i < count($teamTotalsAndTimes) && $i < 10; $i++)
		{
			$this->Leader->create();
			
			$duration = date_diff(new DateTime($teamTotalsAndTimes[$i][0]['max_dt_completed']), 
				new DateTime($teamTotalsAndTimes[$i][0]['min_dt_started']));
			
			$leader = array('Leader' => array(
				'rank' => $i + 1,
				'team_id' => $teamTotalsAndTimes[$i]['Team']['id'],
				'team_name' => $teamTotalsAndTimes[$i]['Team']['name'],
				'score' => $teamTotalsAndTimes[$i][0]['project_ct'],
				'duration' => $duration->format('%d days, %h hours, %i minutes, %s seconds'),
				'dt_entered' => $batch
			));
			
			$this->Leader->save($leader);
		}
		
		$this->set('users', $userTotalsAndTimes);
		$this->set('teams', $teamTotalsAndTimes);
	}
	
	/**
	 * 
	 */
	function _updateLeaders()
	{
		//$$todo update the leaderboard tables and dispatch messages to the concerned parties
		//$$todo tweet/FB share updates of our new leaders
	}
}