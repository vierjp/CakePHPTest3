<?php
/**
 * Created by JetBrains PhpStorm.
 * User: User
 * Date: 2013/06/28
 * Time: 22:22
 * To change this template use File | Settings | File Templates.
 */

class PostsController extends AppController {
    //public $scaffold;
    public $helpers = array('Html','Form');

    public function index(){
        $this->log('PostsController#index called.', 'debug');
        $params = array(
          'order' => 'modified desc',
            'limit' => 5
        );
        $this->set('posts',$this->Post->find('all',$params) );
        $this->set('title_for_layout','記事一覧');
    }

    public function view ($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }

    public function add () {
        if($this->request->is('post')){
            if($this->Post->save($this->request->data)){
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            }else{
                $this->Session->setFlash('Failed!');
            }
        }
    }

    public function edit ($id = null) {
        $this->log('PostsController#edit called.', 'debug');
        $this->Post->id = $id;
        if($this->request->is('get')){
            $this->request->data = $this->Post->read();
        }else{
            if($this->Post->save($this->request->data)){
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            }else{
                $this->Session->setFlash('Failed!');
            }
        }
    }


    public function delete ($id = null) {
        $this->Post->id = $id;
        if($this->request->is('get')){
            throw new MethodNotAllowedException();
        }

        if($this->Post->delete($id)){
            $this->Session->setFlash('Deleted!');
            $this->redirect(array('action'=>'index'));
        }

    }

}