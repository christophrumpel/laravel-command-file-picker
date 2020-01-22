# Laravel Command File Picker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/christophrumpel/laravel-command-file-picker.svg?style=flat-square)](https://packagist.org/packages/christophrumpel/laravel-command-file-picker)
[![Build Status](https://img.shields.io/travis/christophrumpel/laravel-command-file-picker/master.svg?style=flat-square)](https://travis-ci.org/christophrumpel/laravel-command-file-picker)
[![Quality Score](https://img.shields.io/scrutinizer/g/christophrumpel/laravel-command-file-picker.svg?style=flat-square)](https://scrutinizer-ci.com/g/christophrumpel/laravel-command-file-picker)
[![Total Downloads](https://img.shields.io/packagist/dt/christophrumpel/laravel-command-file-picker.svg?style=flat-square)](https://packagist.org/packages/christophrumpel/laravel-command-file-picker)

This package lets you show a list of files or classes to choose from during a Laravel command.

![Screenshot of the command](http://screenshots.nomoreencore.com/laravel_command_file_picker_classes_v1.png)
![Screenshot of the command](http://screenshots.nomoreencore.com/laravel_command_file_picker_models_v1.png)
![Screenshot of the command](http://screenshots.nomoreencore.com/laravel_command_file_picker_files_v1.png)


## Reasons You Might Need This Package

While using Laravel commands, you may need to run them on specific files or classes. Let's say you want to run some actions on one of your Laravel models. In the past, you may have passed a class or file as an argument to the command. This works, but it is quite cumbersome and leads to typing mistakes.

This package will make it easy for the user by prompting a list of files or classes. (like in the screenshot above) The user can then easily select one, and you can use it inside your command.

## Installation

You can install the package via composer:

```bash
composer require christophrumpel/laravel-command-file-picker
```

## Usage

### Load Classes

To show the user a list of classes, you need to use the package's trait called `PicksClasses`. Just add it to one of your Laravel commands. (Be aware that you have to create your Laravel commands yourself.)

```
<?php

use Illuminate\Console\Command;


class MyLaravelCommand extends Command
{
  use PicksClasses;
  
  //...

}
```

After that you are able to show the user a list of files to choose from by calling the new `askToPickClasses` method:

```
$modelClass = $this->askToPickClasses(base_path('app/Models'));
```

This will show the user all the classes and give you back the selected class in your command. If you just need Laravel models, you can also load them like:

```
$modelClass = $this->askToPickModels());
```

It will automatically look for models under your `app/Models` path.

### Load Files

To show the user a list of files, you need to use the package's trait called `PicksFiles`. Just add it to one of your Laravel commands.

```
<?php

use Illuminate\Console\Command;


class MyLaravelCommand extends Command
{
  use PicksFiles;
  
  //...

}
```

After that you are able to show the user a list of files to choose from by calling the new `askToPickFiles` method. As a parameter you provide a directory path.

```
$file = $this->askToPickFiles(base_path('app/Models'));
```

This will show the user all the files and give you back the selected file path in your command.

## Next Up

- config to define model directory
- load classes with specific parent class using an interface

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
