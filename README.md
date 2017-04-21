# HeliMenuGenerator
HTML Menu Generator that plays well with bootstrap

## Why Built
This was because in every new project i do for some client i start with the same menu so i needed a menu genertor to save time as much as possible

## What does HeliMenuGenerator exactly generate?
HeliMenuGenerator just generates multi level html `ul` list this because every project has it's own styling

## installation
in `config/app` file 
1- the `providers` section add the following ling
```php
Helilabs\HeliMenuGenerator\LaravelLogic\HeliMenuGeneratorServiceProvider::class,
```

2- the `aliases` section add the following ling
```php
'Menu' => Helilabs\HeliMenuGenerator\LaravelLogic\HeliMenuGenerator::class,
```


## How to use HeliMenuGenerator?
fisrt create a menu Array like this
```php
$menu = [
    'dashboard' => [
        'icon' => 'ti-panel',
        'text' => trans('messages.dashboard'),
        'url' => url('/')
    ],
    'users' => [
        'icon' => 'ti-user',
        'text' => trans('messages.users'),
        'url' => url('/')
    ],
    'productsContainer' => [
        'icon' => 'ti-package',
        'text' => trans('messages.products'),
        'url' => '#',
        'children' => [
            'products' => [
                'icon' => 'ti-package',
                'text' => trans('messaegs.products'),
                'url' => url('/products'),
            ],
            'categories' => [
                'icon' => 'ti-layers-alt',
                'text' => trans('messages.categories'),
                'url' => url('/categories')
            ]
        ]
    ],
    'orders' => [
        'icon' => 'ti-shopping-cart',
        'text' => trans('messages.orders'),
        'url' => url('/')
    ],
];
```
then use menu generator to do the rest
```php
{!! HeliMenuGenerator::parse( $menu ) !!}
```