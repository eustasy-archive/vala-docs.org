# [vala-docs.org](https://vala-docs.org/)

## Usage

#### Requirements
- `libxml2-dev` package
- `valadoc` package
- PHP 5.6 or 7.0
- PHP pgsql extension
- PHP xml extension
- PostgreSQL

#### Generating new XML files
```
cd doc-gen
make
```
The newest .vapi and .gir files are automatically downloaded from the [Vala-Girs repository][3].
After generation is done there is one json file per package in `doc-gen/docs`.

#### Database setup
vala-docs will automatically setup your database tables, all you need to so is
configure your database in `_settings/database.php` and run `php doc-gen/database.php`.

#### Running
You can be run vala-docs behind a web server like nginx or directly by running
`php -S 0.0.0.0:8000 index.php` and navigating to http://localhost:8000.

## Contribution
- Expect _everything_ to be HTTPS.
- Files and folders that start with underscores are hidden on the server.

## Roadmap
- Create a generator of XML files, one per package, with `valadoc`
- Setup an easy to use PostgreSQL database with generated XML files
- Use database for a simple php generated doc site
- Add javascript for simple client side rendering
- Search, maybe with [DuckDuckGo][2] or PostgreSQL.

[1]: https://github.com/erusev/parsedown-extra
[2]: https://duckduckgo.com/search.html?kaj=m&kae=c&duck=yes&width=350&site=vala-docs.org&prefill=Search%20Vala%20Docs
[3]: https://github.com/nemequ/vala-girs
