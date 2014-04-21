NOD-Rss-Reader
==============

Simple rss storing and searching built with CakePHP

##Install##

```bash
git clone git@github.com:NOD-Studios/NOD-Rss-Reader.git
composer update
```

Add some feeds than click to "Fetch All".

##API##

**First page items**
```
/items.json
```
**Next page items**
```
/items/index/page:2.json
```
**Search**
```
/items/search/Example Query.json
```
*(for testing a query with interface: ```/items/search/Example Query```)*
