<?php

$userName = $user['User']['name'];
$teamName = '';

$userPartsTotal = 0;
$userProjectsCompleted = array();

$teamPartsTotal = 0;
$teamProjectsCompleted = array();

if(isset($team)) $teamName = $team['Team']['name'];

for($i = 0; $i < count($round); $i++)
{
	if($round[$i]['Round']['dt_completed'] != '0000-00-00 00:00:00')
	{
		if($round[$i]['Round']['user_id'] == $user['User']['id'])
		{
			$userPartsTotal += count($round[$i]['Part']);
			array_push($userProjectsCompleted, $round[$i]['Project']['asset_id']);
		}
		
		else
		{
			$teamPartsTotal += count($round[$i]['Part']);
			array_push($teamProjectsCompleted, $round[$i]['Project']['asset_id']);
		}
	}
}

$projectsCompleted = array_merge($userProjectsCompleted, $teamProjectsCompleted);
sort($projectsCompleted);

?><section id="video"><?php
	for($i = 0; $i < count($projectsCompleted); $i++): ?>
<model id="<?php echo $projectsCompleted[$i]; ?>" />
<?php endfor; ?>
</section>
<section id="user">
	<name><?php echo $userName; ?></name>
	<parts><?php echo $userPartsTotal; ?></parts>
	<projects><?php echo count($userProjectsCompleted); ?></projects>
</section>
<section id="team">
	<name><?php echo $teamName; ?></name>
	<parts><?php echo $teamPartsTotal; ?></parts>
	<projects><?php echo count($teamProjectsCompleted);?></projects>
</section>
<section id="map">
<?php
//$$todo populate the points of map interest
/*
	<point x="100" y="100" label="Fabric" />
	<point x="100" y="200" label="PVC Pipe" />
*/?>
</section>
<section id="leader">
	<list id="users"><?php echo implode('<br/>', $leaders['User']); ?></list>
	<list id="teams"><?php echo implode('<br/>', $leaders['Team']); ?></list>
</section>