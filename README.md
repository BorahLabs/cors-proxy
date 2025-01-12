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

## Borah Digital Labs
[Borah Digital Labs](https://borah.digital/) crafts web applications, open-source packages, and offers a team of full-stack solvers ready to tackle your next project. We have built a series of projects:

- [CodeDocumentation](https://codedocumentation.app/): Automatic code documentation platform
- [AutomaticDocs](https://automaticdocs.app/): One-time documentation for your projects
- [Talkzy](https://talkzy.app/): A tool to summarize meetings
- Compass: An agent-driven tool to help manage companies more efficiently
- [Prompt Token Counter](https://prompttokencounter.com/): Simple tool to count tokens in prompts
- [Sabor en la Oficina](https://saborenlaoficina.es/): Website + catering management platform
- [Prompt Token Counter](https://www.prompttokencounter.com/): Simple free tool to count tokens in prompts
- [PDF to Markdown](https://pdftomarkdown.app/): Simple free tool to convert PDF files into Markdown format

We like to use Laravel for most of our projects and we love to tackle big, complicated problems. Feel free to reach out and we can have a virtual coffee!

We like to use Laravel for most of our projects and we love to tackle big, complicated problems. Feel free to reach out and we can have a virtual coffee!
