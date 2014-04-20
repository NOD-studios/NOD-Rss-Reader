<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 * @property PaginatorComponent $Paginator
 */
class ItemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Item->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 25,
            'order' => array(
                'Item.date' => 'desc'
            )
        );

        $this->set('items', $this->Paginator->paginate());
    }

    public function search($query = null) {
        $query = $this->Item->getDataSource()->value($query);
        $this->Paginator->settings = array(
            'conditions' => array(
                'OR' => array(
                    array("MATCH (Item.title) AGAINST ({$query})"),
                    array("MATCH (Item.content_plain) AGAINST ({$query})"),
                    array("MATCH (Item.content) AGAINST ({$query})")
                )
            ),
            'limit'      => 25
        );
        $items = $this->Paginator->paginate();
        $this->set(compact('items', 'query'));
        $this->render('index');
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Item->exists($id)) {
            throw new NotFoundException(__('Invalid item'));
        }
        $options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
        $this->set('item', $this->Item->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Item->create();
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash(__('The item has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The item could not be saved. Please, try again.'));
            }
        }
        $feeds = $this->Item->Feed->find('list');
        $this->set(compact('feeds'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Item->exists($id)) {
            throw new NotFoundException(__('Invalid item'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash(__('The item has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The item could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
            $this->request->data = $this->Item->find('first', $options);
        }
        $feeds = $this->Item->Feed->find('list');
        $this->set(compact('feeds'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->Item->id = $id;
        if (!$this->Item->exists()) {
            throw new NotFoundException(__('Invalid item'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Item->delete()) {
            $this->Session->setFlash(__('The item has been deleted.'));
        } else {
            $this->Session->setFlash(__('The item could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }}
