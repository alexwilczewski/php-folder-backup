<?php
require_once('lib/BackupRecord.php');

$zipPath = BackupRecord::getPath();
$backupPath = getBackupPath();
createBackupDirectoryIfNecessary($backupPath);
copy($zipPath, $backupPath);

function getBackupPath() {
    $directory = Config::$config['local']['location'];
    $fileName = sprintf('sysbk_%s.zip', date('Ymd'));
    return sprintf('%s/%s', $directory, $fileName);
}

function createBackupDirectoryIfNecessary($backupPath) {
    $backupDirectory = dirname($backupPath);
    if(is_dir($backupDirectory) === false) {
        createBackupDirectory($backupDirectory);
    }
}

function createBackupDirectory($backupDirectory) {
    mkdir($backupDirectory, 0600, true);
}
