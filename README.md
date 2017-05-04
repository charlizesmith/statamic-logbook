# Logbook - View log files in the CP

Viewing log files directly on the server can be a bit of a hassle... First you have to `ssh` in, `cd` to the project's logs directory, and finally open each one only to see the biggest mangle of info logs and errors logs with stack traces.

Logbook solves this by displaying each log file in a table and collapsing the stack traces to keep things nice and tidy.
You can view a full stack trace by clicking on it.

![logbook](https://cloud.githubusercontent.com/assets/5065331/25707073/b59f8560-30e2-11e7-8ac7-3aef0347c9cd.png)

## Setup

* Copy the `Logbook` folder into `site/addons/`.
* Run `php please update:addons` or click 'Refresh' in the CP (`Configure` > `Addons`).
* Enjoy!

## Settings

If you want to hide Logbook from showing in the nav menu, head over to `Configure` > `Addons` > `Logbook` and toggle the hide setting. Logbook will remain accessible, but only when using the direct url to the Addon: `/cp/addons/logbook`, this can be useful to hide logs from other CP users while keeping it open to devs.
