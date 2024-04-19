# Change Log

## v0.7.0

* Support new check bulk permissions api introduced in spicedb 1.30.0
* Deprecate experimental bulk check permission api
* Context type changed from mixed to array|null
* Update rector + config
* Set up unit tests to run on GitHub action

## v0.6.0

* Require PHP 8.1
* Convert all Enum classes to actual enums
* Update PHPUnit to 10.x
* Add rector to require-dev

## v0.5.2

Don't overwrite __toString method of RpcException to avoid suppressing the stacktrace.

## v0.5.1

Fix handling for streamed LookupResources and LookupSubjects responses that are in [JSON lines](https://jsonlines.org/) 
format rather than valid JSON.

## v0.5.0

Major new release up to date with SpiceDB 1.25+. Except for the experimental APIs, things should be stable going
forward.

* Adds [Caveat](https://authzed.com/docs/reference/caveats) support
* Improved Types and PHPDoc
* Shortened client method and enum names 
* Unit tests for all current APIs
* Throw RpcErrors instead of returning RpcStatus objects when SpiceDB returns an error.
* Throw ValidationExceptions when required parameters are not passed
* Add support for experimental APIs (requires a currently unreleased version of spicedb)

## v0.1.13 and Prior

Alpha Quality proof of concept with support for most critical schema update, relationship writing, and permission 
checking operations. Was written and tested mostly against SpiceDb 1.13. Typing and error handling leave a lot to be desired.

