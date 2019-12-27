<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Common;
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
        $commLinks = $this->paginate($this->CommLinks);
    	$xml = simplexml_load_file(ROOT . DS . 'TandSData.xml');
    	/*$this->loadModel('CommLinks');
        $table = [];
        $lib = new Common();
    	foreach ($xml->children() as $tr) {
        	$line_raw = $lib->parseColumn($tr, 1);
        	$line = trim($line_raw['text']);
        	if (substr($line, 0, 2) === 'PW') {
        		$table[$line] = true;
        	}
        } 
        */
        $uplinks = $this->getLinkNames("uplinks");
        $this->set(compact('commLinks', 'uplinks'));
    }
    
    private function getLinkNames($type) {
        $map = [];
    	$xml = Xml::build(ROOT . DS . 'TandSData.xml');
    	foreach ($xml as $tr) {
    		$col4 = (Xml::toArray($tr->td[3]))['td'];
    		if (is_string($col4)) {
    			$str = trim($col4);
    			$map[$str] = $str;
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
            'contain' => []
        ]);

        $this->set('commLink', $commLink);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commLink = $this->CommLinks->newEntity();
        $commLink->name = $this->request->query('name');
        if ($this->request->is('post')) {
            $commLink = $this->CommLinks->patchEntity($commLink, $this->request->getData());
            $commLink->id = $commLink->name;
            $commLink->properties = ['location'=>$commLink->properties];
            if ($this->CommLinks->save($commLink)) {
                $this->Flash->success(__('The comm link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comm link could not be saved. Please, try again.'));
        }
        $this->set(compact('commLink'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commLink = $this->CommLinks->patchEntity($commLink, $this->request->getData());
            if ($this->CommLinks->save($commLink)) {
                $this->Flash->success(__('The comm link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comm link could not be saved. Please, try again.'));
        }
        $this->set(compact('commLink'));
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
}
