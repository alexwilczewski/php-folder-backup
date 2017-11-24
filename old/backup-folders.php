<?php
require_once('config/config.php');
require_once('lib/BackupRecord.php');

// TODO: Force run as root.

$zipFilePath = tempnam(sys_get_temp_dir(), 'sysbk_');
$zip = new ZipArchive();
$response = $zip->open($zipFilePath, ZipArchive::CREATE);
if($response === true) {
    $directories = getDirectoriesToBackup();
    foreach($directories as $directory) {
        addDirectoryToZip($directory, $zip);
    }
    $zip->close();
    BackupRecord::storePath($zipFilePath);
} else {
    error_log('Zip open failed with: ' . $response);
}


function getDirectoriesToBackup() {
    return Config::$config['backup']['directories'];
}

function addDirectoryToZip($directory, &$zip) {
    $directoryHandle = DirectoryHandle::open($directory);
    while($directoryHandle->next()) {
        $fileName = $directoryHandle->get();
        if (isActualFile($fileName)) {
            $absoluteFilePath = sprintf('%s/%s', $directory, $fileName);
            $storePath = substr($absoluteFilePath, 1); // removeLeadingSlash
            if (is_file($absoluteFilePath)) {
                $zip->addFile($absoluteFilePath, $storePath);
            } elseif (is_dir($absoluteFilePath)) {
                $zip->addEmptyDir($storePath);
                addDirectoryToZip($absoluteFilePath, $zip);
            }
        }
    }
    $directoryHandle->close();
}

function isActualFile($fileName) {
    if($fileName === '.') {
        return false;
    } else if($fileName === '..') {
        return false;
    }
    return true;
}

class DirectoryHandle {
    private $item;
    private $handle;

    static public function open($directory) {
        return new DirectoryHandle($directory);
    }

    private function __construct($directory) {
        $this->handle = opendir($directory);
    }

    public function next() {
        $this->item = readdir($this->handle);
        return $this->hasItem();
    }

    public function get() {
        return $this->item;
    }

    public function close() {
        closedir($this->handle);
    }

    private function hasItem() {
        return (($this->item !== false) ? true : false);
    }
}
