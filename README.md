# Active Housing

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require ogunsakindamilola/active-housing
```

## Usage
To get a user:
```php
(new ActiveHousingService())->getUser($userId);
```

To get paginated users list:
```php
(new ActiveHousingService())->getPaginatedUsers($pageId);
```
### Testing

```bash
vendor\bin\phpunit
```
