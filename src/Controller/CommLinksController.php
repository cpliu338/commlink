<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Utility\Xml;
/**
 * CommLinks Controller
 *
 * @property \App\Model\Table\CommLinksTable $CommLinks
 *
 * @method \App\Model\Entity\CommLink[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommLinksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
    	$column = $this->request->getQuery('column');
    	$value = $this->request->getQuery('value');
    	if ($column=='id') {
    		$commLinks = $this->paginate($this->CommLinks->find()->where([
				'id LIKE'=>"%".$value."%"
			]));
    	}
    	else if ($column=='type') {
    		$commLinks = $this->paginate($this->CommLinks->find()->where([
				'type LIKE'=>"%".$value."%"
			]));
    	}
    	else if ($column=='properties') {
    		$v = "%$value%"; // when passed to find()->where() CakePHP automatically makes it lower case
    		$query = $this->CommLinks->find()->where([
				"json_search(LOWER(properties), 'one', '$v') IS NOT "=>null
			]);
    		$commLinks = $this->paginate($query);
    	}
    	else
	        $commLinks = $this->paginate($this->CommLinks);
        $broadbands = $this->CommLinks->find('list')
			->where(['type'=>'broadband'])->toArray();
		$uplinks = [];
		$ar = $this->getLinkNames("uplinks");
		ksort($ar);
        foreach ($ar as $key=>$encoded) {
        	if (!array_key_exists($key, $broadbands))
        		$uplinks[$key] = $encoded;
        }
        $privatewires = $this->CommLinks->find('list')
			->where(['type'=>'leased_line'])->toArray();
        $nodes = [];
		$ar = $this->getLinkNames("nodes");
		ksort($ar);
        foreach ($ar as $key=>$encoded) {
        	if (!array_key_exists($key, $privatewires))
        		$nodes[$key] = $encoded;
        }
        $this->set(compact('commLinks', 'uplinks', 'nodes', 'column', 'value'));
    }
    
    /** Suggest links for a select menu
    param by request parameters
    */
    public function suggest() {
    	$req = $this->getRequest();
    	if ($req->is('ajax')) {
    		$attr = $req->getQuery('attribute');
    		$value = $req->getQuery('value');
    		$results = $this->CommLinks->find()->where([$attr=>$value])->toArray();
    		$this->set(compact('results'));
    		$this->set('_serialize', 'results');
    	}
    }
    
    private function getLinkNames($type) {
        $map = [];
    	$xml = Xml::build(ROOT . DS . 'TandSData.xml');
    	if ($type == "uplinks") {
    		foreach ($xml as $tr) {
				$col4 = (Xml::toArray($tr->td[3]))['td'];
				if (is_string($col4)) {
					$str = trim($col4);
					$map[$str] = urlencode($str);
				}
    		}
    	}
    	if ($type == "nodes") {
    		foreach ($xml as $tr) {
				$col2 = (Xml::toArray($tr->td[1]))['td'];
				if (is_string($col2)) {
					$str = trim($col2);
					if (substr($str, 0, 2) == 'PW')
						$map[$str] = urlencode($str);
				}
    		} 
    	}
    	return $map;
    }

    /**
     * View method
     *
     * @param string|null $id Comm Link id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commLink = $this->CommLinks->get($id, [
            'contain' => ['Rtus']
        ]);
        $this->set('commLink', $commLink);
    }

    /**
     * Add method
     * Auto increment primary key is not used, the name param becomes the id
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	$name = $this->request->getQuery('name');
    	if ($this->CommLinks->exists(['id'=>$name]))
    		return $this->redirect(['action'=>'edit', $name]);
        $commLink = $this->CommLinks->newEntity();
        $commLink->name = $name;
        $commLink->type = $this->request->getQuery('type');
        $commLink->remark = '';
        $attributes = Configure::read('JsonCommLink.'.$commLink->type, []);
        foreach (Configure::read('JsonCommLink', []) as $k => $v)
        	$types[$k] = $k;
        if ($this->request->is('post')) {
            $commLink = $this->CommLinks->patchEntity($commLink, $this->request->getData());
            //$commLink->properties = //['location'=>$commLink->properties];
            //$commLink->marshalAttr($this->request->getData());
            if ($this->CommLinks->save($commLink)) {
                $this->Flash->success(__('The comm link has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comm link could not be saved. Please, try again.'));
        }
        $this->set(compact('commLink', 'attributes', 'types'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comm Link id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commLink = $this->CommLinks->get($id, [
            'contain' => []
        ]);
        //$commLink->name = $id;
        //$commLink->populateAttr();
        $attributes = Configure::read('JsonCommLink.'.$commLink->type, []);
        foreach (Configure::read('JsonCommLink', []) as $k => $v)
        	$types[$k] = $k;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commLink = $this->CommLinks->patchEntity($commLink, $this->request->getData());
            //$commLink->marshalAttr($this->request->getData());
            //$commLink->dirty('properties', true);
            if ($this->CommLinks->save($commLink)) {
                $this->Flash->success(__('The comm link has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comm link could not be saved. Please, try again.'));
        }
        $this->set(compact('commLink', 'attributes', 'types'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comm Link id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commLink = $this->CommLinks->get($id);
        if ($this->CommLinks->delete($commLink)) {
            $this->Flash->success(__('The comm link has been deleted.'));
        } else {
            $this->Flash->error(__('The comm link could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
    * Mock up location service, returning static suggestions for Tuen
    */
    public function mimicLocationService() {
    	return $this->response->withFile(ROOT . DS . 
    		'locations.json');
    }
    
}
