Yii2 Header Checker
=========
Yii2 Request Header checker filter

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
composer require --prefer-dist uzdevid/yii2-header-checker "*"
```

or add

```
"uzdevid/yii2-header-checker": "1.0.0"
```

to the require section of your `composer.json` file.


Usage
-----

```
public function behaviors(): array {
    $behaviors = parent::behaviors();

    $behaviors['HeaderCheck'] = [
        'class' => HeaderCheckerFilter::class,
        'actions' => [
            'verify' => ['User-Agent', 'Device-Id', 'Device-Type'],
            'refresh' => ['Refresh-Token']
        ],
    ];
    
    return $behaviors;
}
```

