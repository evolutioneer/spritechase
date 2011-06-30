<?php

class LeadersController extends AppController
{
	var $name = 'Leaders';
	var $uses = array('Leader', 'Cron', 'CronLog', 'Message', 'SocialShare');	
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
	function cron($id)
	{
		//$$todo check the validity of the key against a known secret hash
		//$$todo check the CronLog table and verify that the row with this ID was not run in the past 15 minutes
		//$$todo if so, execute the command in the row of the Cron table with the given ID
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