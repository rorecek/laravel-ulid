# Laravel ULID

Laravel package to generate ULID (Universally Unique Lexicographically Sortable Identifier), which also contains trait for your models that will let you generate ULID ids for your Eloquent models automatically. Based on [robinvdvleuten/php-ulid](https://github.com/robinvdvleuten/php-ulid).

### What is a ULID?

In many cases universally unique identifier (UUID) can be suboptimal for many uses-cases because:

* It isn't the most character efficient way of encoding 128 bits of randomness
* UUID v1/v2 is impractical in many environments, as it requires access to a unique, stable MAC address
* UUID v3/v5 requires a unique seed and produces randomly distributed IDs, which can cause fragmentation in many data structures
* UUID v4 provides no other information than randomness which can cause fragmentation in many data structures

Instead, ULID offers:

* 128-bit compatibility with UUID
* 1.21e+24 unique ULIDs per millisecond
* Lexicographically sortable!
* Canonically encoded as a 26 character string, as opposed to the 36 character UUID
* Uses Crockford's base32 for better efficiency and readability (5 bits per character)
* Case insensitive
* No special characters (URL safe)

You can read more [here](https://github.com/alizain/ulid)

### What are the benefits?

1. With distributed systems you can be pretty confident that the primary key’s will never collide.

2. When building a large scale application when an auto increment primary key is not ideal.

3. It makes replication trivial (as opposed to int’s, which makes it REALLY hard)

4. Safe enough doesn’t show the user that you are getting information by id, for example `https://example.com/item/10`


## Installation

You can install this package via composer using this command:

``` bash
 composer require rorecek/laravel-ulid:^2.0
```

#### Laravel 5.5+
There is nothing else to do as the service provider and facade are going to be automaticaly discovered.

#### Laravel 5.3 and 5.4
You must install the service provider and facade:

```php
// config/app.php
'providers' => [
    ...
    Rorecek\Ulid\UlidServiceProvider::class,
];

...

'aliases' => [
    ...
    'Ulid' => Rorecek\Ulid\Facades\Ulid::class,
];
```


## Usage

### Migrations

When using the migration you should change $table->increments('id') to:

``` php
$table->char('id', 26)->primary();
```

> Simply, the schema seems something like this.

``` php
Schema::create('items', function (Blueprint $table) {
  $table->char('id', 26)->primary();
  ....
  ....
  $table->timestamps();
});
```

If the related model is using an ULID, the column type should reflect that also.

``` php
Schema::create('items', function (Blueprint $table) {
  $table->char('id', 26)->primary();
  ....
  // related model that uses ULID
  $table->char('category_id', 26);
  $table->foreign('category_id')->references('id')->on('categories');
  ....
  $table->timestamps();
});
```

### Models

To set up a model to use ULID, simply use the HasUlid trait.

``` php
use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class Item extends Model
{
  use HasUlid;
}
```

### Controller

When you create a new instance of a model which uses ULIDs, this package will automatically add ULID as id of the model.

``` php
// 'HasUlid' trait will automatically generate and assign id field.
$item = Item::create(['name' => 'Awesome item']);
echo $item->id;
// 01brh9q9amqp7mt7xqqb6b5k58
```


## Support

If you believe you have found an issue, please report it using the [GitHub issue tracker](https://github.com/rorecek/laravel-ulid/issues), or better yet, fork the repository and submit a pull request.

If you're using this package, I'd love to hear your thoughts. Thanks!


## License

The MIT License (MIT). [Pavel Rorecek](https://laravelist.com)
