
# Filters

A Laravel package for saving and reusing query based filtering.

## Installation

Via Composer

``` bash
$ composer require daveismyname/laravel-filters
```

In Laravel 5.5 the service provider will automatically get registered. In older versions of the framework just add the service provider in config/app.php file:

```
'providers' => [
    // ...
    Daveismyname\Filters\FiltersServiceProvider::class,
];
```

You can publish the migration with:

```
php artisan vendor:publish --provider="Daveismyname\Filters\FiltersServiceProvider" --tag="migrations"
```

After the migration has been published migrate it:

```
php artisan migrate
```

You can publish the config file with:

```
php artisan vendor:publish --provider="Daveismyname\Filters\FiltersServiceProvider" --tag="config"
```

When published, the config/filters.php config file contains:

```
<?php

return [

    
];
```

## Model

Access filter model, to access the model reference this ORM model

```
use Daveismyname\Filters\Models\Filter;
```


## Usage

>Note this package expects a user to be logged in.

A routes example:

```

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('showfilters', function(){
        return Filters::get();
    });
});
```


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## Contributing

Contributions are welcome and will be fully credited.

Contributions are accepted via Pull Requests on [Github](https://github.com/daveismyname/laravel-filters).

## Pull Requests

- **Document any change in behaviour** - Make sure the `readme.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](http://semver.org/). Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## Security

If you discover any security related issues, please email dave@daveismyname.com email instead of using the issue tracker.

## License

license. Please see the [license file](license.md) for more information.
