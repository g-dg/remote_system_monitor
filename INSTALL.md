Garnet Degelder's Simple Remote System Monitor
==============================================

Installation instructions
-------------------------

For installation instructions, see the INSTALL.md files in the `client` and `server` folders.

The client will need to be installed on each machine you want to monitor.
The server will need to be installed on the machine that each client will report to.

System Requirements
-------------------

### Client
- Unix-based system (e.g. Linux or BSD)
- Python 3.4 or later
- systemd for included service file (works with others as well)

### Server
- PHP 7 or later (some more recent versions of PHP 5 may work, but are unsupported)
- PHP SQLite3 module
- A webserver that is configured to run PHP
