# Introduction

This is WordPress plugin that fetches data from JSON API [jsonplaceholder](https://jsonplaceholder.typicode.com).

[Jsonplaceholder](https://jsonplaceholder.typicode.com) provides dummy API and this plugin uses this endpoint [https://jsonplaceholder.typicode.com/users](https://jsonplaceholder.typicode.com/users) which has dummy data for users.

The plugin fetches the data from the API and displays these users in a table.

This plugin demonstrates the basics of getting data from an API, validation, displaying, phpunit testing the data as well as making ajax API call.  For simplicity reason I choose jQuery and plain JavaScript to handle the request on the front end, React could have been used for this amongst others.

## Installing Dependencies
Navigate to the root of this plugin and then do:
```bash
composer install
```

## Testing
Again while on the root directory of this plugin do:
`./vendor/bin/phpunit` tests

## Usage
Install the plugin and then navigate to `/test-url` and you will see a table with the users which data we are getting from the endpoint mentioned above i.e. `https://jsonplaceholder.typicode.com/users`.

When clicking on id, user name or name of any user an AJAX API call is made bringing the rest of the details for that particular user.
