#!/usr/bin/env python3

CONFIG_FILE = "./client.conf"

import configparser
import os
import urllib.request
import urllib.parse
import urllib.error
import time

config_parser = configparser.ConfigParser()
config_parser.read(CONFIG_FILE)

config = {
	"ServerAddress": config_parser["main"]["ServerAddress"],
	"ClientKey": config_parser["main"]["ClientKey"],
	"UpdateDelay": float(config_parser["main"]["UpdateDelay"]),
}

while True:
	load = os.getloadavg()[0] / os.cpu_count()

	request_vars = {
		"key": config["ClientKey"],
		"loadavg": load
	}
	request_data = urllib.parse.urlencode(request_vars)
	request_data = request_data.encode('ascii')
	request = urllib.request.Request(url = config["ServerAddress"], data = request_data, method = "POST")
	try:
		response = urllib.request.urlopen(request, timeout = 5.0)
		response_text = response.read()
		response.close()
	except urllib.error.HTTPError:
		pass

	time.sleep(config["UpdateDelay"])
