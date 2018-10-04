# Drip SDK

[![Author](http://img.shields.io/badge/author-@mikebarlow-red.svg?style=flat-square)](https://twitter.com/mikebarlow)
[![Latest Version](https://img.shields.io/github/release/mikebarlow/drip-sdk.svg?style=flat-square)](https://github.com/mikebarlow/drip-sdk/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/mikebarlow/drip-sdk/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/mikebarlow/drip-sdk/master.svg?style=flat-square)](https://travis-ci.org/mikebarlow/drip-sdk)

## Introduction

Drip SDK is a PSR-2 Compliant Object Orientated PHP SDK for the Drip Email Marketing software API.

## Requirements

### Composer

Drip-sdk requires the following:

* "php": ">=5.6.0"
* "guzzlehttp/guzzle": "6.3.*"
* "cartalyst/collections": "1.1.*"
* "snscripts/getset": "1.0.*"
* "snscripts/result": "1.0.*"

And the following if you wish to run in dev mode and run tests.w

* "phpunit/phpunit": "5.7.5"
* "squizlabs/php_codesniffer": "2.0"

## Tests

To run the tests, simply checkout the package and navigate to the package root in command line.

Run `composer install` to bring in all the dev dependencies. Then you can run `./vendor/bin/phpunit` to run all the Unit Tests and `./vendor/bin/phpcs --standard=PSR2 ./src` to run the code sniffer for any PSR2 errors.


## Usage

For current documentation, see the [docs](https://github.com/mikebarlow/drip-sdk/tree/master/docs) folder


## Changelog

You can view the changelog [HERE](https://github.com/mikebarlow/drip-sdk/blob/master/CHANGELOG.md)

## Contributing

Please see [CONTRIBUTING](https://github.com/mikebarlow/drip-sdk/blob/master/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/mikebarlow/drip-sdk/blob/master/LICENSE) for more information.

