
# Development

Some of the features has been added to this project. See the following sections for more details.

Clone this directory and run

```bash
/path/to/project/bin/install
```

You may found the following commands are useful during development:

| Command | Description |
|---------|-------------|
| `php artisan reload:db` | Drop all tables and remigrate and seed database |
| `php artisan reload:cache` | Clear all caches and cache back all caches available |
| `php artisan reload:all` | Run `reload:cache` and `reload:db` |
| `php artisan seed:prepare` | By default this command run `PrepareSeeder` which seed all necessary data for first time deployment. This command run by default in `reload:db` command |
| `php artisan seed:dev` | Seed any data for development purpose. You may configure `DevSeeder` to meet your requirements. |

You may run other make commands which available under `app/Console/Commands/Make` namespace.

## Running Docker

```bash
docker compose up -d
```

## Database Schema Documentation

First, run the following command:

```bash
php artisan db:schema
```

Then login to your app and visit your app at `http://domain/doc/db-schema`.

Or you can see the link at the sidebar: `Db Schema`

## Datatable

Adding Delete Bulk Action by simply import the `InteractsWithDestroy` trait then add in the datatable class:

```php
public array $bulkActions = [
    'destroyConfirmation' => 'Delete',
];
protected $listeners = [
    'destroyRecord' => 'destroy',
];
```

Adding Action by using `ActionColumn` class:

```php
ActionColumn::make('Actions', 'uuid')
```

By default it use `$model->getResourceUrl()` to generate the URL for actions. But you can ovewrite by providing `setView('path.to.view')`.

## API

API Development are based on Dingo API. Refer to [wiki](https://github.com/dingo/api/wiki) for more details.

An example has been created in `routes/api/_.php`.

Sample usage:

```php
<?php

$client = new http\Client;
$request = new http\Client\Request;

$request->setRequestUrl('https://project.test/api/user');
$request->setRequestMethod('GET');
$request->setHeaders([
  'Accept' => 'application/vnd.project.v1+json',
  'Authorization' => 'Bearer [YOUR-API-KEY]'
]);

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
```

Accept header, by default you can get the value by:

```php
api_accept_header();
```

This will return default Accept header. By default is: `application/vnd.project.v1+json`.

If you are developing newer version, make sure to define in routes the API version and simply change the version number when consuming the API, such as:

```php
$request->setHeaders([
  'Accept' => 'application/vnd.project.v2+json',
  'Authorization' => 'Bearer [YOUR-API-KEY]'
]);
```

Unless you don't need the old API version, you are safely update default `API_VERSION` in `.env` file.

**<span style="color:red">IMPORTANT</span>**

Before you decided to let consumer to use the API, do choose, either to use domain or path base for the API.

If you are choosing domain based, define `API_DOMAIN` in your `.env`, else define `API_PREFIX`.

You may want to import Insomnia [file](Insomnia.json) to test out your APIs.

## Livewire

Using Alert component:

```php
$this->dispatch('alert', 'displayAlert',  __('Connection'), __('Connection succesfully deleted'));
```

Using Confirm component:

```php
<div class="cursor-pointer" class="bg-red-500"
    wire:click="$dispatch('confirm', 'displayConfirmation', 'Delete Connection', 'Are you sure?', 'connection-form', 'destroyConnection', '{{ $uuid }}')">
    {{ __('Remove') }}
</div>
```

Both of the Alert & Confirm modal are using the Laravel Jetstream modal.

Using Datatable Actions:

```php
public function columns(): array
{
    return [
        Column::make('Name', 'name')
            ->sortable(),
        Column::make('Actions', 'uuid')
            ->format(
                fn ($value, $row, Column $column) => view('livewire.datatable-actions', ['form' => 'resource-form', 'value' => $value, 'row' => $row, 'column' => $column])
            ),
    ];
}
```

To create a form to edit / update, you need to create Livewire component first:

```bash
php artisan make:livewire Device
```

Then use the `InteractsWithLivewireForm` trait. All the properties defined below are required.

```php
<?php

namespace App\Http\Livewire;

use App\Actions\Sensor\CreateNewDevice;
use App\Concerns\InteractsWithLivewireForm;
use App\Models\Device;
use Livewire\Component;

class DeviceForm extends Component
{
    use InteractsWithLivewireForm;

    public string $model = Device::class;
    public string $action = CreateNewDevice::class;
    public string $formTitle = 'Device';
    public string $view = 'livewire.device-form';
    protected $listeners = [
        'showRecord' => 'show',
        'destroyRecord' => 'destroy',
    ];
    public $state = [
        'name' => '',
    ];
}
```
