# XAMPP_Network
Social media website template using XAMPP

## Using this on your own system
1. Get XAMPP ~ https://www.apachefriends.org/download.html
2. In a terminal window cd to xampp/htdocs
3. Delete everything within htdocs
4. Clone this repo into xampp/htdocs ~ git clone git@github.com:antonkoetzler/XAMPP_Network.git
5. (Linux) You'll probably need to chmod the htdocs directory for read+write to have no errors updating profile pictures and posting pictures
6. Configuring the database
    1. Start Apache and MySQL in the XAMPP control panel and go to localhost/phpmyadmin in your browser ~ https://imgur.com/a/MPmJNse
    2. On the very left, click "New" near the cylinders, name the database 'user' and click create ~ https://imgur.com/a/TSET9Fy
    3. Using the "Tables" section below, click "New" under the new user database and create these tables
4. Done, try to create a profile on your local XAMPP network

## Tables
### user_credentials
1. id ~ AUTO_INCREMENT ~ int
2. username ~ VARCHAR(20)
3. email ~ VARCHAR(256)
4. name ~ VARCHAR(256)
5. password ~ TINYTEXT

imgur: https://imgur.com/a/ZE5mrm7

SQL code (create table with pure SQL if you please):
```
CREATE TABLE user_credentials (
  id int(11) not null PRIMARY KEY AUTO_INCREMENT,
  username varchar(256) not null,
  email varchar(256) not null,
  name varchar(256) not null,
  password tinytext not null
);
```


### user_pfp
1. id ~ AUTO_INCREMENT ~ int
2. userid ~ int
3. status ~ int

imgur: https://imgur.com/a/6KVLH5w

SQL code:
```
CREATE TABLE user_pfp (
  id int(11) not null PRIMARY KEY  AUTO_INCREMENT,
  userid int(11) not null,
  status int(11) not null
);
```

### user_content
1. id ~ AUTO_INCREMENT ~ int
2. userid ~ int
3. title ~ VARCHAR(100) 
4. caption ~ TINYTEXT
5. filename ~ TINYTEXT

imgur: https://imgur.com/a/pDvg7y3

SQL code:
```
CREATE TABLE user_content (
  id int(11) not null PRIMARY KEY AUTO_INCREMENT,
  userid int(11) not null,
  title varchar(100) not null,
  caption tinytext not null,
  filename tinytext not null
);
```
