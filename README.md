# FileJet Nette extension

This library extends Nette Framework and adds functionality of FileJet service for use with external images.

# Installation

Simply require the library via [Composer](https://getcomposer.org/):

```bash
composer require filejet/filejet-nette ^1.0
```

Then add the extension to your `config.neon`:

```neon
extensions:
    filejet: FileJet\Nette\DI\Extension
```

# Configuration

You can set several configuration options within your `config.neon`:

```neon
filejet:
    storageId: '<storage id>' # required
    basePath: '<base path of your images>' # optional
    lazyLoadAttribute: '<provide this if you use lazy loading>' # optional; defaults to "data-src"
    filterName: '<latte filter name>' # optional; changes the Nette filter name; defaults to "replace_images"
```

# Usage

You need to include FileJet SDK JavaScript at the end of your `<head>` tag:

```html
<script src="https://cdn.filejet.io/sdk.v1.js"></script>
``` 

Within your Latte templates you call `replace_images` filter:

```latte
{capture $content}
<p>
<img src="https://example.com/images/logo.jpg" />
</p>
{/capture}

{$content|replace_images|noescape}
```
