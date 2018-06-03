#!/bin/bash

source config
BACKUP_FILE="`pwd`/backup.list"
tar_cmd="tar --create --preserve-permissions --to-stdout --files-from=$BACKUP_FILE"
sevenz_cmd="7za a -si -mhe=on -p$PASS $OUT_FILE"

cd $CWD
shopt -s dotglob
$tar_cmd | $sevenz_cmd
shopt -u dotglob
