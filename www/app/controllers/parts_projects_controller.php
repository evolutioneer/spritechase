<?php

class PartsProjectsController extends AppController
{
	var $name = 'PartsProjects';
	var $uses = array('Part', 'Project', 'PartsProject');
	
	function beforeFilter()
	{
		$this->Auth->authorize = 'controller';
	}
	
	function isAuthorized()
	{
		return $this->Auth->user('role') == 'admin';
	}
	
	function update()
	{
		if($this->data)
		{
			//$$testme if no project was selected, error out
			if(!isset($this->data['Project']))
			{
				$this->Session->setFlash('Error: Choose a project.');
			}
			
			else
			{
				$projectId = $this->data['Project']['id'];
				
				//$$testme clean out the old PartProject records for this project
				$partsProject = $this->PartsProject->find('all', array('conditions' => array('project_id' => $projectId)));
				
				for($i = 0; $i < count($partsProject); $i++)
				{
					$this->PartsProject->delete($partsProject[$i]['PartsProject']['id']);
				}
				
				foreach($this->data['Part'] as $key => $value)
				{
					$this->PartsProject->create();
					$this->PartsProject->save(array('PartsProject' => array(
						'part_id' => $key,
						'project_id' => $projectId
					)));
				}
				
				$this->Session->setFlash('Data saved');
			}
		}
		
		//$$testme set the data we need in order to build the form
		$this->Project->contain();
		$this->Part->contain();
		$this->set('projects', $this->Project->find('all', array('order' => 'name ASC')));
		$this->set('parts', $this->Part->find('all', array('order' => 'name ASC')));
	}
}