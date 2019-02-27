
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

```bash
php artisan vendor:publish --provider="Daveismyname\Filters\FiltersServiceProvider" --tag="migrations"
```

After the migration has been published migrate it:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Daveismyname\Filters\FiltersServiceProvider" --tag="config"
```

When published, the config/filters.php config file contains:

```php
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

```php
Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('demo', function(){
        $filters = Filters::get();

        return view('demo');
    });
});
```

the `get` accepts 2 optional params:
1) The name of the module/section ie users
2) The relative url to redirect to ie /admin/users

In demo.blade.php view:

Save a filter:
```php
<form method="get">
    <div class="control-group">
        <label for='savedfilter'>Use a saved filter:</label>
        <select name='savedfilter' id="savedfilter" class='form-control' onchange="this.form.submit()">
        <option value=''>Select</option>
        @if ($filters)
            @foreach($filters as $filter)
                <option value='{{ $filter->id }}'>{{ $filter->title }}</option>
            @endforeach
        @endif
        </select>
    </div>
</form>
```

Remove a filter
```php
<form method="get">
    <div class="control-group">
        <label for='removefilter'>Remove a saved filter:</label>
        <select name='removefilter' id="removefilter" class='form-control' onchange="this.form.submit()">
        <option value=''>Select</option>
        @if ($filters)
            @foreach($filters as $filter)
                <option value='{{ $filter->id }}'>{{ $filter->title }}</option>
            @endforeach
        @endif
        </select>
    </div>
</form>
```

Store a new filter
```php
<form method="get">
    <div class="control-group">
        <label for='filterTitle'>Save filter:</label>
        <input class='form-control' id='filterTitle' type="text" name="filterTitle" value="" />
    </div>

    <div class="control-group">
        <br><button type="submit" id='savefilter' class="btn btn-success" name="savefilter"><i class="fa fa-check"></i> Save Filter</button>
    </div>
</form>
```

For the filter actions to run call `run($module, $url)` 
```php
Filters::run('users', 'admin/users');
```

Internally there are 3 methods that will be called based on the query string parameters:

When `savefilter` exists in the url then `storeFilter()` will run to store the filter.
Also storeFilter requires a `filterTitle` parameter to give a name to the filter.


When `savedfilter` exists in the url then `applyFilter()` will return the filter stored.
When `removefilter` exists in the url then `deleteFilter()` will run to delete the filter.

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
