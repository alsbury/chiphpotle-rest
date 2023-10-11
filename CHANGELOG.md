# Change Log

## v0.5.0

Major new release up to date with SpiceDB 1.25+

* Adds [Caveat](https://authzed.com/docs/reference/caveats) support
* Improved Types and PHPDoc
* Unit tests for all current APIs
* Throw RpcErrors instead of returning RpcStatus objects when SpiceDB returns an error.
* Throw ValidationExceptions when required parameters are not passed
* Add support for experimental APIs (requires a currently unreleased version of spicedb)

## v0.1.13 and Prior

Alpha Quality proof of concept with support for most critical schema update, relationship writing, and permission 
checking operations. Was written and tested mostly against SpiceDb 1.13. Typing and error handling leave a lot to be desired.

