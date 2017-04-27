# team327website - Scoutcloud

## What is Scoutcloud?

ScoutCloud is an attempt at making the scouting life in FTC easier. A lot of team members found that scouting can be very hectic, having to scribble notes in a messy notebook and constantly looking up information. ScoutCloud attempts to consolidate the experience into an intuitive and easy to use system, with powerful search queries and the ability to view teams based on match performance, geographical information, or user input.

Scoutcloud utilizes PHP, a server scripting language developed for web applications. It ties in mySQL and MongoDB as the main storage structures, and utilizes javascript for various front-end UI features.

## How to start using ScoutCloud

To start using ScoutCloud, make sure to download the dependencies listed below.
### Dependencies

#### XAMPP
This bundles Apache, mySQL, and PHP all into one program that you can easily use. If you are using Linux, download LAMP or use Ubuntu server and install each service.
  * https://www.apachefriends.org/xampp-files/7.1.1/xampp-win32-7.1.1-0-VC14-installer.exe

#### MongoDB
Download the community server for whatever operating system you have.
  * https://www.mongodb.com/download-center?jmp=nav
  
If you also want a GUI for MongoDB, download MongoDB Compass.
  * https://www.mongodb.com/download-center?jmp=nav#compass
  
To start using MongoDB with PHP, we will need to download the driver for MongoDB for PHP.  
  * https://pecl.php.net/package/mongodb

If you are using XAMPP, you can go ahead and put the driver into the following folder:
```C:\xampp\php\ext```
Afterwards, go ahead and update the following information in the php.ini file:

```
;;;;;;;;;;;;;;;;;;;;;;;;;
; Paths and Directories ;
;;;;;;;;;;;;;;;;;;;;;;;;;

; UNIX: "/path1:/path2"
include_path=C:\xampp\php\PEAR
;
; Windows: "\path1;\path2"
include_path = "c:\xampp\php\includes"
```

```
; Windows Extensions
; Note that ODBC support is built in, so no dll is needed for it.
; Note that many DLL files are located in the extensions/ (PHP 4) ext/ (PHP 5+)
; extension folders as well as the separate PECL DLL download (PHP 5+).
; Be sure to appropriately set the extension_dir directive.
;
; Add this line below \/
extension=php_mongodb.dll
```

#### Composer
To properly use the driver, we will need to install Composer.
  * https://getcomposer.org/download/

Go ahead and put the file "composer.json" inside your includes folder in PHP.

### Database Setup
Set up your mySQL and MongoDB databases, and create the proper includes file for the credentials and put it in ```c:\xampp\php\includes```. This tutorial will assume that you have prior knowledge of how to do this. If not, reference the documentation listed below. Be sure to use authentication for both databases. 

#### Note
MongoDB may not create the necessary folder when installing. If so, create the following path: ```C:\data\db```

### Final Steps
Once everything is installed, go ahead and boot everything up and put the files inside the htdocs folder in XAMPP. ```C:\xampp\htdocs```
Take the "includes" folder and put it in ```c:\xampp\php\includes```

## Documentation and Resources
In case you don't understand something or need to freshen up on a coding language, I've compiled a list of resources that you can use.
#### MongoDB shell
  * https://docs.mongodb.com/manual/
#### MongoDB Driver and PHP Library
There is a PHP Library API that is built on top of the primitive driver. You will rarely have to use anything on the lower level of the driver. Most of the methods used in this code reference the high level abstraction PHP library.
  * https://docs.mongodb.com/php-library/master/
#### mySQL
  * https://dev.mysql.com/doc/refman/5.7/en/
#### PHP
  * https://www.w3schools.com/php/

## Understanding ScoutCloud
Within this GitHub there are multiple files with the suffix \_tutorial which will give you short tutorials on certain processes.

### Information Storage Structure
Each team that signs up for the service recieves their own collection in the mongo DB. 
What this does is each team has their own information on teams, which is separate and unaccessable by the other teams.
Basically, each team has it's own set of data that it can view.

However, there is a global comment system that is shared across all teams, and every team can make comments and view comments from other teams on entries. 

Within the database itself, there is a template collection called "teams" which contains basic information that the team collections will copy from and update periodically.

Next to that, there is the "comments" collection, which stores all comments for any team.

Finally, each team has their own collection, named with their team number.

### Page Function Breakdown
#### Backend
  * <b>validate_login.php</b> as well as it's variants - checks if the user is signed in and prevents access to pages requiring login.
  * <b>session.php</b> - destroys the session after a set amount of time
#### Login
  * <b>index.php</b> - serves as the UI for the login system.
  * <b>login.php</b> - performs the login function, calling Login.php as a new object.
  * <b>Login.php</b> - actually does the connection to the mySQL server and verifies account information, as well as connecting to MongoDB and updating the appropriate team collection. 
  * <b>register.php</b> - performs the register function, calling Registration.php as a new object.
  * <b>Registration.php</b> - actually does the connection the mySQL server and creates a new account after data validation, and connects to the MongoDB server and checks if a new collection needs to be made.
#### Scouting
  * Each page references validate_login.php and session.php.
  * <b>index.php</b> - UI for the scouting service. Contains links to search, edit, and list all teams
  * <b>edit.php</b> - A form that collects team number/team name to be edited. Submits to teamedit.php through POST.
  * <b>teamedit.php</b> - Serves as the UI for editing a team. Grabs team information from the database using the specified search criteria sent through POST from edit.php, then formats it and displays it on the page. Submits to teamsubmit.php through POST. It can also grab team information using GET, which is only used when accessing the editing interface from a team page.
  * <b>teamsubmit.php</b> - Data validates all form information sent through POST from teamedit.php and inputs it into the team document in the collection. Performs an upsert.
  * <b>commentsubmit.php</b> - Data validates and runs comments sent through POST from team.php and checks them for profanity. The comment is then added to the collection with the team number of the page it was posted on and the person who submitted it.
  * <b>team.php</b> - Retrieves information about the team from the database, then formats it and displays it on the page. Contains an quickedit button which sends the user to teamedit.php with a GET request. Comments can be submitted through POST on this page.
  * <b>search.php</b> - Contains the search form used to lookup a team. Sends information with a GET request, so that the same request can be looked up/used later.
  * <b>results.php</b> - Retrieves search criteria sent through GET from search.php, then generates a search criteria array and uses it to look up any teams matching the criteria in the database. 
  * <b>teams.php</b> - Retrieves every team in the collection, formats it, and displays it.
  
### What would I need to change if I were updating the objectives or adding a new information field?
  * edit.php
  * teamedit.php
  * teamsubmit.php
  * team.php
  * search.php
  * results.php
  
## Using GitHub
When using GitHub, there are a few things that should be followed.

When developing new features, push them to the GitHub, but use a different branch other than master. This is to ensure that if something goes wrong you can revert to a version you know that works. I will push an example branch for you so you can see how to do it.

When making commits, follow this naming convention:

```v#.#.# - <insert descriptive title or the name of the milestone which you are completing>```

For the version, the first number is the major version number. The second number is the minor version number (used for less important updates). The third number is basically a hotfix number. Increment this when you have super minor or small changes to the code.
