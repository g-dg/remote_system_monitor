#!/bin/sh

cd "$(dirname "$0")" || exit

cp ping.py /usr/bin/garnetdg_monitor.py
chmod +rx /usr/bin/garnetdg_monitor.py

cp client.example.conf /etc/garnetdg_monitor.conf
chmod +r /etc/garnetdg_monitor.conf

cp garnetdg_monitor.service /etc/systemd/system/garnetdg_monitor.service
systemctl enable garnetdg_monitor.service
systemctl start garnetdg_monitor.service
