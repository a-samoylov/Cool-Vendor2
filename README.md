## What is this?

This project is a extension for Magento 2.

Extension implements the work with the our API it is done for educational purposes.
We can create different commands with alias and version command. 

### Installing

Download Magento 2.* and deploy extension files in magento.

```
Download from https://magento.com/tech-resources/download
```

Put in database bearer tokens. For example:

```
Bearer token: '58trbv2fuaw9egsa'
```

### Example

This application has two protocol.

GET:
```
var xhr = new XMLHttpRequest();
xhr.open('GET', 'format1?params={"limit":"100"}&command=GetProducts&version=1.0', true);
xhr.setRequestHeader('someapi_bearer_token', '58trbv2fuaw9egsa');
xhr.send();
```

POST:
```javascript
var xhr = new XMLHttpRequest();
var pack = {
    command: 'GetProducts',
    version: '2.0',
    params: {
        limit: '2'
    }
};

xhr.open('POST', 'http://somehost.com/magento/someapi/format2', true);
xhr.setRequestHeader('someapi_bearer_token', '58trbv2fuaw9egsa');
xhr.send(JSON.stringify(pack));
```

## Authors

Alexander Samoylov
> [LinkedIn](https://www.linkedin.com/in/alexander-samoylov/)

> [GitHub](https://github.com/a-samoylov)
