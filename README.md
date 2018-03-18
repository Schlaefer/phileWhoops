# phileWhoops

[![Build Status](https://travis-ci.org/Schlaefer/phileWhoops.svg?branch=master)](https://travis-ci.org/Schlaefer/phileWhoops)

Adds a [Whoops](https://github.com/filp/whoops/) to [Phile](https://github.com/PhileCMS/Phile) for development. [Project home](https://github.com/Schlaefer/phileWhoops).

## Installation

```
composer require siezi/phile-whoops
```

## Activation

```
$config['plugins']['siezi\\phileWhoops'] = ['active' => true];
```

## Usage

After the plugin is activated and an error occurs whoops is shown.

## Configuration

See the `config.php`.
