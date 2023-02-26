[![Latest Stable Version](https://poser.pugx.org/codeq/htmlcontent/v/stable)](https://packagist.org/packages/codeq/htmlcontent)
[![License](https://poser.pugx.org/codeq/htmlcontent/license)](LICENSE)

# HTML Content nodes for Neos CMS

#### The successor of [CodeQ.HtmlWidget](https://github.com/code-q-web-factory/neos-htmlwidget)

Create content nodes with HTML code, e.g. external players or iframe embeds. Manage who can create and editor those nodes with the role `CodeQ.HtmlContent:HtmlWidgetDefinitionEditor`.

## Features

* Validates HTML and prevents the backend from breaking by not rendering broken HTML
* Automatically removes JavaScript code in the backend, to not break the Neos Administration
* Used media assets can be set on the node, so these assets can not be deleted.


[![HTML Content Demo](https://img.youtube.com/vi/QLe6tRWsYWQ/0.jpg)](https://youtu.be/QLe6tRWsYWQ)

*The development and the public-releases of this package are generously sponsored by [Code Q Web Factory](http://codeq.at).*

## Installation

CodeQ.HtmlContent is available via packagist. `"codeq/htmlcontent" : "~1.0"` to the require section of the composer.json or run:

```bash
composer require codeq/htmlcontent
```

We use semantic-versioning so every breaking change will increase the major-version number.

## You want to define your own NodeType or different Fusion?

Just set the NodeType to abstract and do your own thing:
```yaml
'CodeQ.HtmlContent:Content.Html':
  abstract: true
```
```yaml
'YOUR.PACKAGE:Content.Html':
  superTypes:
    'CodeQ.HtmlContent:Content.Html': true
```

```neosfusion
prototype(YOUR.PACKAGE:Content.Html) < prototype(Neos.Neos:ContentComponent) {
  renderer = afx`
    <div class="container">
      <CodeQ.HtmlContent:Content.Html isEditable={false}/>
    </div>
  `
}
```

## License

Licensed under MIT, see [LICENSE](LICENSE)

## Contribution

We will gladly accept contributions. Please send us pull requests.
