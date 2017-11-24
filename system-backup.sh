#!/bin/bash

date_as_string=`date +%Y-%m-%d`
password=`cat pass`

cd /
shopt -s dotglob
tar -cpf - \
    --exclude=proc \
    --exclude=lost+found \
    --exclude=tmp \
    --exclude=mnt \
    --exclude=dev \
    --exclude=sys \
    --exclude=run \
    --exclude=media \
    --exclude=var/log \
    --exclude=var/cache/apt/archives \
    --exclude=usr/src/linux-headers* \
    --exclude=home/*/.gvfs \
    --exclude=home/*/.cache \
    --exclude=home/*/.local/share/Trash * \
    | \
    7za a -si -mhe=on -p$password /tmp/backup-$date_as_string.tar.7z
shopt -u dotglob
