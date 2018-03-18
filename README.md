phileDebugbar
=============

[![Build Status](https://travis-ci.org/Schlaefer/phileWhoops.svg?branch=master)](https://travis-ci.org/Schlaefer/phileWhoops)

Adds a [Whoops](http://phpdebugbar.comhttps://github.com/filp/whoops/) to [Phile](https://github.com/PhileCMS/Phile) for development.


### 1. Installation

```
composer require siezi/phile-whoops
```

### 2. Activation

```
$config['plugins']['siezi\\phileWhoops'] = ['active' => true];
```

### 3. Usage ###

After the plugin is activated and an error occurs whoops is shown.
