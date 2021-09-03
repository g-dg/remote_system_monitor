#!/usr/bin/env python3

CONFIG_FILE = "./client.conf"

import configparser
import os
import multiprocessing
import requests

config = configparser.ConfigParser()
config.read(CONFIG_FILE)


