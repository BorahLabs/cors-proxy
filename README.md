# CORS Proxy

CORS Proxy is a CLI tool based on [Laravel Zero](https://laravel-zero.com/) and it's extremely useful to remove all the CORS errors you might have when developing locally.

## Why

Unfortunately we don't always have the luxury of having access to the back-end or the ability to change the CORS headers. This tool will help you to bypass that issue.

## Requirements

To use CORS Proxy, you need to have PHP 8.1+ installed on your computer. Also, you need to have [Composer](https://getcomposer.org/) installed.

## Installation

To install CORS Proxy, you need to run the following command:

```bash
composer global require borah/cors-proxy
```

## Usage

The usage is pretty simple. This is the command structure:

```bash
cors-proxy <host> {--headers=} {--port=1337}
```

The `host` argument is the URL of the host you want to proxy. The `--headers` option should be a JSON with default headers to send in all requests. The `--port` option is used to specify the port you want to use for the proxy server.

## Example

```bash
cors-proxy "https://httpbin.org"
```

This command will start the proxy server on port 1337 and will proxy all requests to `https://httpbin.org`.

```bash
curl -X GET "http://localhost:1337/get?foo=bar&baz=qux" -H "x-custom-header: custom value"
```
