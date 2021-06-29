<h1 align="center"> Portfolio </h1>

<div align="center">
   Solution for a challenge from  <a href="http://devchallenges.io" target="_blank">Devchallenges.io</a>.
</div>

<div align="center">
  <h3>
    <a href="https://phasmatechnologies.com/portfolio/">
      Solution
    </a>
    <span> | </span>
    <a href="https://devchallenges.io/challenges/5ZnOYsSXM24JWnCsNFlt">
      Challenge
    </a>
  </h3>
</div>

## Table of Contents
- [Overview](#overview)
- [Built With](#built-with)
- [Features](#features)
- [How To Use](#how-to-use)
- [Contact](#contact)

## Overview
<img src="https://phasma-technologies.s3.us-east-2.amazonaws.com/devchallenges/portfolio.png">

This project was based on DevChallenge's Portfolio project. 

### Built With
- HTML5
- CSS3
- [Bootstrap](https://getbootstrap.com) for layout
- JavaScript
- MySQL
- PHP
- AJAX

## Features
This application/site was created as a submission to a [DevChallenges](https://devchallenges.io/challenges) challenge. The [challenge](https://devchallenges.io/challenges/5ZnOYsSXM24JWnCsNFlt) was to build an application to complete the given user stories.

I also chose to interpret their rule about creating your own layout <em>very</em> loosely and also used it to showcase some more of my UI and PHP skills, as well as getting in more practice with AJAX for the projects section.


## How To Use
To run this webpage, you'll need to make use of the files in the templates folder. You'll need a working database and to plug its related credentials into the access.php file.

### access.php
A file used to make the database connection, and should always be placed outside the root directory of your web project. Depending on where this project is created, update the number in $db to change where the include is pulling this file from. 

### template.sql 
A file with the create statements for the schema, tables, and columns for the database being used in this project.

### Updating Thumbnails
To set the thumbnails for the projects, ensure they're all pulling from the same directory, and plug that directory's path, whether local or remote, into $thumbnailUrl in projects.class.php.


## Contact
- GitHub [@ETstudios](https://github.com/ETstudios)
- Twitter [@ET_Studios](https://twitter.com/ET_Studios)