# Database setup

Note: This is a technical document explaining how vala-docs uses it's database.
It has no use other than developer notes as vala-docs will automatically create
tables.

Moving up and down the hierarchy can be done with searching dot separated ids.

packages
  - name
  - namespaces by package

namespaces
  - id (key)
  - name
  - package
  - deprecated
  - visibility

classes
  - id (key)
  - name
  - deprecated
  - visibility
  - abstract
  - compact
  - fundamental
  - parent_base (id)
  - parent_interface[] (id)
  - members[] (id)
