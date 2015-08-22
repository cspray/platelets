# Platelets

A template rendering system and a real-life example of why composition is awesome.

The rendering system is nothing fancy, at its core it is just a simple output buffering, file inclusion algorithm you've probably seen about a thousand times. The real beauty of this library is its composition by design philosophy. By providing simple, composable objects you can build a rendering system that is as simple or as complex as you need it to be.

## Installation

We recommend you use [Composer](https://getcomposer.org) to install Platelets.

The name of the Composer package is **cspray/platelets**.

The current version is **0.1.0**.

## Hello Platelets

Platelets "Hello World" is a simple rendering process that's very common: render an outer layout with a piece of content rendered inside that layout. Since we imagine most applications that use Platelets to render HTML our example will also be HTML. Please note that you can use Platelets regardless of the type of text you're outputting.

### /templates/layout.php
```
<!DOCTYPE html>
<html>
    <head>
        <title>Our awesome website</title>
    </head>
    <body>
        <header>
            <h1>DoStuff</h1>
        </header>
        <article id="content">
            <?= $_content ?>
        </article>
    </body>
</html>
```

### /templates/hello_plates.php
```
<p>Hello <?= $who ?></p>
```

# and now bring it all together
<?php



$templatesDir = '/templates';
$fileRenderer = new Platelets\FileRenderer($templatesDir);
$twoStepRenderer = new Platelets\TwoStepRenderer($fileRenderer, 'layout');
echo $twoStepRenderer->render('hello_plates', new AdhocContent(['who' => 'Platelets']));
```

The above code will produce the following output:

```html
<!DOCTYPE html>
<html>
    <head>
        <title>Our awesome website</title>
    </head>
    <body>
        <header>
            <h1>DoStuff</h1>
        </header>
        <article id="content">
            <p>Hello Platelets</p>
        </article>
    </body>
</html>
```

For more examples of how you can use Renderer please check out the code in the `/examples` directory.
