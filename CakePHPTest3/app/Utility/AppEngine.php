<?php

class AppEngine {
    public static function isProduction() {
        if(isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
            //syslog(LOG_WARNING, 'is Production.');
            return true;
        }else{
            //syslog(LOG_WARNING, 'is DevServer.');
            return false;
        }

    }
}