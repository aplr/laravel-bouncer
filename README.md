# 🦍 Bouncer 

## Introduction

The `bouncer` package enables you to restrict access to your apis using application keys.

## Installation

Require the aplr/laravel-bouncer package in your composer.json and update your dependencies:

```shell
$ composer require aplr/laravel-bouncer
```

## Usage

In order to check if requests to your api include a valid key, you can use the Bounce-middleware:

```php
protected $middlewareGroups = [
    'web' => [
       // ...
    ],

    'api' => [
        // ...
        \Aplr\Bouncer\Bounce::class,
    ],
];
```

To generate a new key, simply use the following method:

```php
use Aplr\Bodybuilder\Facades\Bouncer;

$key = Bouncer::createKey('My App');
```

You can manually check if a given key is valid by using the following method:

```php
$valid = Bouncer::check('ZKEpwUSii5yvWt1xgLwHd8yguQGBZtrSi39hXFFd');
```