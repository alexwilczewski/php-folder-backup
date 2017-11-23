#!/bin/bash

date_as_string=`date +%Y-%m-%d`

shopt -s dotglob
cd /
tar -cvpzf /tmp/backup-$date_as_string.tar.gz \
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
    --exclude=home/*/.local/share/Trash *
shopt -u dotglob
