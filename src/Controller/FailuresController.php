<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Failures Controller
 *
 * @property \App\Model\Table\FailuresTable $Failures
 *
 * @method \App\Model\Entity\Failure[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FailuresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CommLinks']
        ];
        $failures = $this->paginate($this->Failures);

        $this->set(compact('failures'));
        $this->set('_serialize', ['failures']);
    }

    /**
     * View method
     *
     * @param string|null $id Failure id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $failure = $this->Failures->get($id, [
            'contain' => ['CommLinks']
        ]);

        $this->set('failure', $failure);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $failure = $this->Failures->newEntity();
        if ($this->request->is('post')) {
            $failure = $this->Failures->patchEntity($failure, $this->request->getData());
            if ($this->Failures->save($failure)) {
                $this->Flash->success(__('The failure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The failure could not be saved. Please, try again.'));
        }
        $links = $this->Failures->CommLinks->find('list', ['limit' => 200]);
        $this->set(compact('failure', 'links'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Failure id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $failure = $this->Failures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $failure = $this->Failures->patchEntity($failure, $this->request->getData());
            if ($this->Failures->save($failure)) {
                $this->Flash->success(__('The failure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The failure could not be saved. Please, try again.'));
        }
        $links = $this->Failures->CommLinks->find('list', ['limit' => 200]);
        $this->set(compact('failure', 'links'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Failure id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $failure = $this->Failures->get($id);
        if ($this->Failures->delete($failure)) {
            $this->Flash->success(__('The failure has been deleted.'));
        } else {
            $this->Flash->error(__('The failure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
