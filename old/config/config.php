<?php
class Config {
    public static $config = array(
        'backup' => array(
            'directories' => array(
                '/home/alex/Projects/mmc',
            ),
            'record' => 'var/record.txt',
        ),
        'local' => array(
            'location' => '/var/sysbackups',
        ),
    );
}
