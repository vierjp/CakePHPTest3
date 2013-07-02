<?php
App::uses('DatabaseSession', 'Model/Datasource/Session');

class ComboSession extends DatabaseSession implements CakeSessionHandlerInterface {
    public $cacheKey;

    public function __construct() {
        CakeLog::write('debug',"ComboSession#__construct");
        $this->cacheKey = Configure::read('Session.handler.cache');
        parent::__construct();
    }

    // セッションからデータ読み込み
    public function read($id) {
        CakeLog::write('debug',"ComboSession#read id:".$id);
        $result = Cache::read($id, $this->cacheKey);
        if ($result) {
            CakeLog::write('debug',"ComboSession#read result from cache result:".$result);
            return $result;
        }
        CakeLog::write('debug',"ComboSession#read result from db result:".$result);
        return parent::read($id);
    }

    // セッションへデータ書き込み
    public function write($id, $data) {
        CakeLog::write('debug',"ComboSession#write id:".$id." data:".$data);
        $result = Cache::write($id, $data, $this->cacheKey);
        CakeLog::write('debug',"ComboSession#write cache id:".$id);
        if ($result) {
            CakeLog::write('debug',"ComboSession#write db id:".$id);
            return parent::write($id, $data);
        }
        CakeLog::write('error',"ComboSession#write failed to write session:".$id);
        return false;
    }

    // セッションの破棄
    public function destroy($id) {
        CakeLog::write('debug',"ComboSession#destroy id:".$id);
        $result = Cache::delete($id, $this->cacheKey);
        if ($result) {
            return parent::destroy($id);
        }
        return false;
    }

    // 期限切れセッションの削除
    public function gc($expires = null) {
        return Cache::gc($this->cacheKey) && parent::gc($expires);
    }
}