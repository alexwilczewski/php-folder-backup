<?php
class Config {
    public static $config = array(
        'backup' => array(
            'directories' => array(),
            'record' => 'var/record.txt',
        ),
        'local' => array(
            'location' => '/var/sysbackups',
        ),
    );
}
