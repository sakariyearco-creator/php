# PHP

PHP is a popular server-side programming language used to build dynamic websites and web applications.

## What is PHP?

PHP stands for **PHP: Hypertext Preprocessor**. It runs on the server and can generate dynamic HTML content.

Example:

```php
<?php

echo "Hello, PHP!";

?>
```

Output:

```text
Hello, PHP!
```

## Basic PHP Concepts

This repository contains examples of important PHP concepts:

* PHP Syntax
* Variables
* Data Types
* Strings
* Numbers
* Operators
* Conditions
* Loops
* Arrays
* Functions
* String Functions
* Forms
* Sessions
* Cookies
* Object-Oriented Programming
* Database Connection
* CRUD Operations

## Variables

PHP variables start with `$`.

```php
$name = "Abdiwasac";
$age = 20;

echo $name;
echo $age;
```

## Echo

`echo` is used to display output.

```php
echo "Welcome to PHP";
```

## Print

`print` is also used to display output.

```php
print "Hello PHP";
```

## String Functions

### `strlen()`

`strlen()` counts the number of characters in a string.

```php
$text = "Hello";

echo strlen($text);
```

Output:

```text
5
```

### `str_word_count()`

`str_word_count()` counts the number of words in a string.

```php
$text = "PHP is easy";

echo str_word_count($text);
```

Output:

```text
3
```

## Conditions

PHP can make decisions using `if`, `elseif`, and `else`.

```php
$age = 20;

if ($age >= 18) {
    echo "Adult";
} else {
    echo "Minor";
}
```

## Loops

Loops are used to repeat code.

```php
for ($i = 1; $i <= 5; $i++) {
    echo $i;
}
```

## Arrays

Arrays store multiple values.

```php
$names = ["Abdiwasac", "Ahmed", "Mohamed"];

echo $names[0];
```

## Functions

Functions are reusable blocks of code.

```php
function greet($name) {
    echo "Hello $name";
}

greet("Abdiwasac");
```

## Database

PHP can work with databases such as:

* MySQL
* MariaDB
* PostgreSQL
* SQLite

PHP can use PDO to connect to databases.

## CRUD

CRUD means:

* **Create**
* **Read**
* **Update**
* **Delete**

These operations are commonly used when building database applications.

## Learning Path

```text
PHP Basics
   ↓
Variables & Data Types
   ↓
Operators
   ↓
Conditions
   ↓
Loops
   ↓
Arrays
   ↓
Functions
   ↓
String Functions
   ↓
Forms
   ↓
OOP
   ↓
Database
   ↓
CRUD
   ↓
APIs
   ↓
Projects
```

## Practice Projects

Some projects to practice PHP:

1. Calculator
2. Login System
3. Registration System
4. To-Do List
5. Student Management System
6. CRUD Application
7. Blog System
8. Simple REST API

## Goal

The goal of this repository is to learn PHP from the basics and gradually build real-world web applications.

**Learn → Practice → Build → Improve**