<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Rtus Controller
 *
 * @property \App\Model\Table\RtusTable $Rtus
 *
 * @method \App\Model\Entity\Rtus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RtusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $rtus = $this->paginate($this->Rtus);
        $this->set(compact('rtus'));
    }

    /**
     * View method
     *
     * @param string|null $id Rtus id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rtus = $this->Rtus->get($id, [
            'contain' => ['CommLinks'],
        ]);

        $this->set('rtus', $rtus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rtu = $this->Rtus->newEntity();
        $this->populate_attr_fields();
        if ($this->request->is('post')) {
            $rtu = $this->Rtus->patchEntity($rtu, $this->request->getData());
            if ($this->Rtus->save($rtu)) {
                $this->Flash->success(__('The rtu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rtu could not be saved. Please, try again.'));
        }
        $commLinks = $this->Rtus->CommLinks->find('list', ['limit' => 200]);
        $this->set(compact('rtu', 'commLinks'));
    }
    
    private function populate_attr_fields() {
        $this->set('attributes', Configure::read('JsonRtu.generic', []));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rtus id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rtus = $this->Rtus->get($id, [
            'contain' => ['CommLinks'],
        ]);
        $this->populate_attr_fields();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rtus = $this->Rtus->patchEntity($rtus, $this->request->getData());
            if ($this->Rtus->save($rtus)) {
                $this->Flash->success(__('The rtus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rtus could not be saved. Please, try again.'));
        }
        $commLinks = $this->Rtus->CommLinks->find('list', ['limit' => 200]);
        $this->set(compact('rtus', 'commLinks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rtus id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rtus = $this->Rtus->get($id);
        if ($this->Rtus->delete($rtus)) {
            $this->Flash->success(__('The rtus has been deleted.'));
        } else {
            $this->Flash->error(__('The rtus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
