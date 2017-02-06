rss-reader
==========
[![Build status](https://travis-ci.org/dorumd/rss-reader-symfony.svg?branch=master)](https://travis-ci.org/dorumd/rss-reader-symfony)


Demo available at: [link](http://mardari.net "link").

To add new feed edit app/config/feeds.yml. Ex:

```
feeds:
    items:
        ny_times:
            base_uri: http://rss.nytimes.com/
            suffix: /services/xml/rss/nyt/HomePage.xml
#            builder: AppBundle\Builder\NYTimesFeedBuilder
```

Builder class parameter is optional, for cases when you have a special feed and you want to do some processing.

Feed data is cached for 60s. Modify `feed_cache_ttl` parameter according to your needs.

To change the amount of feed messages, modify `feed_items_limit` parameter.
