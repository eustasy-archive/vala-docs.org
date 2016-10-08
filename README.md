# [Vala-Docs.org](https://vala-docs.org/)

[![Bountysource](https://www.bountysource.com/badge/tracker?tracker_id=28754245)](https://www.bountysource.com/teams/eustasy/issues?tracker_ids=28754245)

## Installation
### Requirements
- PHP 5.6 or 7.0
- `valadoc` package

### Generating new json-docs
```
cd doc-gen
make
```
The newest .vapi and .gir files are automatically downloaded from the [Vala-Girs repository][3].
After generation is done there is one json file per package in `doc-gen/docs`.

## Contribution
- Expect _everything_ to be HTTPS.
- Files and folders that start with underscores are hidden on the server.

## Roadmap
- Create a generator of XML files, one per package, with `valadoc`
- Parse XML into readable documentation files with [ParseDown Extra][1].
- Search, maybe with [DuckDuckGo][2]

[1]: https://github.com/erusev/parsedown-extra
[2]: https://duckduckgo.com/search.html?kaj=m&kae=c&duck=yes&width=350&site=vala-docs.org&prefill=Search%20Vala%20Docs
[3]: https://github.com/nemequ/vala-girs
