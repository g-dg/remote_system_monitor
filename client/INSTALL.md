Garnet Degelder's Simple Remote System Monitor
==============================================

Simple installation instructions
--------------------------------

Since the executable consists of only a executable file and configuration file, it is relatively easy to install manually.
However, a simple installation (and uninstallation) script has been provided

The install script (`install.sh`) and uninstall script (`uninstall.sh`) are created for systems with systemd and will not install properly on systems without it.

To install with the install script:
1. Edit client.example.conf to match your setup
2. Run `install.sh` as root

To uninstall an existing installation with the uninstall script:
1. Run `uninstall.sh` as root


Advanced installation
---------------------

- `ping.py` <-- main script, must be executable or run with Python 3 by init script
- `client.conf` <-- config file, must be accessible in location defined by `CONFIG_FILE` in `ping.py`
- `garnetdg_monitor.service` <-- systemd service file, typically placed in `/etc/systemd/system/`, can be edited, see `man 5 systemd.service`
