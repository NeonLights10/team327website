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
Set up your mySQL and MongoDB databases, and create the proper includes file for the credentials. This tutorial will assume that you have prior knowledge of how to do this. If not, reference the documentation listed below. Be sure to use authentication for both databases.

#### Note
MongoDB may not create the necessary folder when installing. If so, create the following path: ```C:\data\db```

### Final Steps
Once everything is installed, go ahead and boot everything up and put the files inside the htdocs folder in XAMPP. ```C:\xampp\htdocs```

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

## Using GitHub
When using GitHub, there are a few things that should be followed.

When developing new features, push them to the GitHub, but use a different branch other than master. This is to ensure that if something goes wrong you can revert to a version you know that works. I will push an example branch for you so you can see how to do it.

When making commits, follow this naming convention:

```v#.#.# - <insert descriptive title or the name of the milestone which you are completing>```

For the version, the first number is the major version number. The second number is the minor version number (used for less important updates). The third number is basically a hotfix number. Increment this when you have super minor or small changes to the code.
