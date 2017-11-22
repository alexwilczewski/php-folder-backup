<?php
require_once('config/config.php');

class BackupRecord {
    static public function storePath($filePath) {
        $recordPath = static::getRecordFilePath();
        file_put_contents($recordPath, $filePath);
    }

    static public function getPath() {
        return file_get_contents(static::getRecordFilePath());
    }

    static private function getRecordFilePath() {
        return Config::$config['backup']['record'];
    }
}
