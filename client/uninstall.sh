#!/bin/sh

cd "$(dirname "$0")" || exit

systemctl stop garnetdg_monitor.service
systemctl disable garnetdg_monitor.service
rm /etc/systemd/system/garnetdg_monitor.service

rm /etc/garnetdg_monitor.conf

rm /usr/bin/garnetdg_monitor.py
