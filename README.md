# GothEzPlatformSoundCloud
This bundle adds SoundCloud FieldType into eZ Platform.

In progress..

## Installation
TODO

Enable the bundle in app/AppKernel.php file:

```php
$bundles = array(
    // ...
    new Goth\EzPlatformSoundCloudFieldTypeBundle\GothEzPlatformSoundCloudFieldTypeBundle(),
);
```

Copy assets to your `web` directory using this command:

```
php app/console assets:install --symlink
```

## Contributing
Bug reports and pull requests are welcome on GitHub at https://github.com/goth-pl/ez-platform-soundcloud-fieldtype-bundle

## License
The bundle is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).