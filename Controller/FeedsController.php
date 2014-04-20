<?php
use Html2Text\Html2Text;
App::uses('AppController', 'Controller');
/**
 * Feeds Controller
 *
 * @property Feed $Feed
 * @property PaginatorComponent $Paginator
 */
class FeedsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Feed->recursive = 0;
        $this->set('feeds', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Feed->exists($id)) {
            throw new NotFoundException(__('Invalid feed'));
        }
        $options = array(
            'conditions'=> array(
                'Feed.' . $this->Feed->primaryKey => $id
            ),
            'recursive' => 0
        );
        $this->set('feed', $this->Feed->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Feed->create();
            if ($this->Feed->save($this->request->data)) {
                $this->Session->setFlash(__('The feed has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The feed could not be saved. Please, try again.'));
            }
        }
    }


/**
 * fetchFeed method
 *
 * @return void
 */
    public function fetchFeed($url = false) {
        if(!is_string($url)) {
            return false;
        }
        $feed = new SimplePie();
        $feed->set_cache_location(CACHE);
        $feed->set_feed_url($url);
        $feed->init();
        $feed->handle_content_type();
        return $feed;
    }

/**
 * getFeedData method
 *
 * @return void
 */
    public function getFeedData($find = 'all') {
        $feeds = $this->Feed->find($find);
        $data  = array();
        foreach ($feeds as $key => $feed) {
            if(empty($feed['Feed']['url'])) {
                debug("Empty URL: {$feed['Feed']['name']}");
                continue;
            }
            array_push($data, array(
                'Feed' => $feed['Feed'],
                'Item' => $this->fetchFeed($feed['Feed']['url'])
            ));
        }
        return $data;
    }

/**
 * checkItemExists method
 *
 * @return void
 */
public function checkItemExists($hash = false) {
    if(!$hash) {
        return false;
    }

    $item = $this->Feed->Item->find('first', array(
        'conditions' => compact('hash'),
        'fields'     => array('id')
    ));

    if(!empty($item['Item']['id'])) {
        return $item['Item']['id'];
    }

    return false;
}

protected function prepareDatetime($date = null) {
    App::uses('CakeTime', 'Utility');

    $date = new DateTime($date);
    return $date->format('Y-m-d g:i:s');
}

protected function getText($source = false) {
    $source = new Html2Text($source);
    return $source->get_text();
}

/**
 * addAllItems method
 *
 * @return void
 */
    public function add_all_items() {
        $data = $this->getFeedData('all');
        foreach ($data as $feedData) {
            $push = array();
            foreach($feedData['Item']->get_items() as $item) {
                $hash = $item->get_id(true);
                $id   = $this->checkItemExists($hash);
                $id   = $id ? $id : NULL;
                $content = $item->get_content();



                $Item = compact('id', 'hash') + array(
                    'base'          => $item->get_base(),
                    'title'         => $item->get_title(),
                    'description'   => $item->get_description(),
                    'content'       => $content,
                    'content_plain' => $this->getText($content),
                    'date'          => $this->prepareDatetime($item->get_date()),
                    'permalink'     => $item->get_permalink(),
                    'link'          => $item->get_link(),
                    'links'         => json_encode($item->get_links()),
                    'enclosures'    => json_encode($item->get_enclosures()),
                    'source'        => $item->get_source(),
                    'feed_id'       => $feedData['Feed']['id']
                );
                array_push($this->request->data, compact('Item'));
            }
        }

        //exit(debug($this->request->data[1]));
        if ($this->Feed->Item->saveAll($this->request->data, array(
            'atomic'   => true,
            'deep'     => true,
            'validate' => false
        ))) {
            $this->Session->setFlash(__('The feed items has been saved.'));
            return $this->redirect(array('action' => 'index', 'controller' => 'items'));
        } else {
            $this->Session->setFlash(__('The feed items could not be saved. Please, try again.'));
        }

        $this->render(false);
    }


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Feed->exists($id)) {
            throw new NotFoundException(__('Invalid feed'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Feed->save($this->request->data)) {
                $this->Session->setFlash(__('The feed has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The feed could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Feed.' . $this->Feed->primaryKey => $id));
            $this->request->data = $this->Feed->find('first', $options);
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->Feed->id = $id;
        if (!$this->Feed->exists()) {
            throw new NotFoundException(__('Invalid feed'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Feed->delete()) {
            $this->Session->setFlash(__('The feed has been deleted.'));
        } else {
            $this->Session->setFlash(__('The feed could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }}
