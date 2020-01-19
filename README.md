# Laravel Command File Picker (WIP)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/christophrumpel/laravel-command-file-picker.svg?style=flat-square)](https://packagist.org/packages/christophrumpel/laravel-command-file-picker)
[![Build Status](https://img.shields.io/travis/christophrumpel/laravel-command-file-picker/master.svg?style=flat-square)](https://travis-ci.org/christophrumpel/laravel-command-file-picker)
[![Quality Score](https://img.shields.io/scrutinizer/g/christophrumpel/laravel-command-file-picker.svg?style=flat-square)](https://scrutinizer-ci.com/g/christophrumpel/laravel-command-file-picker)
[![Total Downloads](https://img.shields.io/packagist/dt/christophrumpel/laravel-command-file-picker.svg?style=flat-square)](https://packagist.org/packages/christophrumpel/laravel-command-file-picker)

This package lets a user pick a file from a list during a Laravel command.

![Screenshot of the command](http://screenshots.nomoreencore.com/laravel_factories_reloaded.png)

## Reasons You Might Need This Package

While using Laravel commands, you may need to run them on specific files or classes. Let's say you want to run some actions on one of your Laravel models. In the past, you may have passed a class or file as an argument to the command. This works, but it is quite cumbersome and leads to typing mistakes.

This package will make it easy for the user by prompting a list of files or classes. (like in the screenshot above) The user can then easily select one, and you can use it inside your command.

## Installation

You can install the package via composer:

```bash
composer require christophrumpel/laravel-command-file-picker
```

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).



## Usage

We distinguish between asking files or classes because there are different use-cases. With a file, you may want to copy, compress, or transfer it. This is when you need the path of the file.

With a class, you are probably more interested in the fully qualified class name. You can use it to create a new instance, for example.


### Load Files

To show the user a list of files, you need to use the package's trait called `AskFiles`.

```
<?php

use Illuminate\Console\Command;


class MyLaravelCommand extends Command
{
  use PicksFiles;
  
  //...

}
```

After that you are able to show the user a list of files like:

```
$file = $this->askToPickFile(base_path('resources/json'));
```

This will give you back the chosen file path.


### Load Classes

To show the user a list of classes, you need to use the package's trait called `AskClasses`.

```
<?php

use Illuminate\Console\Command;


class MyLaravelCommand extends Command
{
  use PicksClasses;
  
  //...

}
```

After that you are able to show the user a list of files to choose from:

```
$modelClass = $this->askToPickClass(base_path('app/Models'));
```

This will give you back the selected class. If you just need Laravel models, you can also load them like:

```
$modelClass = $this->askToPickModels());
```

It will automatically look for models under your `app/Models` path.


## Next Up

Next up, I want to add a config file so you can define where your Laravel models live inside your app because this is different for everyone, of course.


```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security-related issues, please email christoph@christoph-rumpel.com instead of using the issue tracker.

## Credits

- [Christoph Rumpel](https://github.com/christophrumpel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
