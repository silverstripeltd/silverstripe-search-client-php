# <img src="https://www.silverstripe.com/favicon.ico" style="height:40px; vertical-align:middle"/> Silverstripe Search PHP Client

> [!WARNING]
> This Client is currently an alpha, and should be treated as experimental. We're still making improvements to our specification export, and this directly impacts the Models that are generated.

## Standards

This Client adheres to the follow PSR standards:

| PSR    | Name                    | Purpose                         |
|--------|-------------------------|---------------------------------|
| PSR-4  | Auto-loading            | Class auto-loading structure    |
| PSR-7  | HTTP Message Interfaces | Request/Response representation |
| PSR-17 | HTTP Factory Interfaces | Create requests, streams, etc   |
| PSR-18 | HTTP Client Interface   | Send requests                   |

## Basic usage

```php
$plugins = [
    new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://9595b293cf40d7532796c4ca67a27b81-bifrost.silverstripe.io')),
    new AddPathPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('/api/v1')),
    new HeaderAppendPlugin([
        'Authorization' => 'Bearer ABC.123.456',
    ]),
];

// When no HTTP Client is provided, PSR-18 discovery will be used, and your plugins will be attached to the HTTP Client
return Client::create(httpClient: null, additionalPlugins: $plugins);
```

Or you might like to use a different HTTP Client, for example, Guzzle:

```php
$httpClient = new GuzzleHttp\Client();
$plugins = [
    new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://9595b293cf40d7532796c4ca67a27b81-bifrost.silverstripe.io')),
    new AddPathPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('/api/v1')),
    new HeaderAppendPlugin([
        'Authorization' => 'Bearer ABC.123.456',
    ]),
];

// Apply the plugins to the HTTP Client
$httpClient = new PluginClient($httpClient, $plugins);

// When an explicit HTTP Client is provided, it will be used
return Client::create($httpClient);
```
