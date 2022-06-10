# The-Exoplanet-Archive(Full Stack)
### Table of Contents
- [Description](#description)
- [Stack](#stack)
- [How To Use](#how-to-use)
- [API & Data](#API-and-Data)
- [Experiences and Lessons Learned](#Experiences)
- [Links](#link)

## Description

The Exoplanet Archive was created to retrieve and present automated confirmed exoplanet discoveries from NASA's exoplanet API. The main idea behind it was to present the data in a simple manner with the help of data visualization. I thought of this idea while watching a video on an exoplanet discovery and found myself wanting to get a better idea of where the planet is relative to its sun. Today I refer to this website when I encounter new discoveries and the data presentation helps me build a mental image of the exoplanet and its properties.

## Stack
- Golang --> Golang was used to make the http API request and mirror the JSON data into a slice consisting of exoplanet structs with its relative properties. It was also used to connect and insert the data into the mysql database table hosted by Suny Oswego's University servers. Lastly it implemets a time() function which calles the API request periodically.

- MySql --> This was the database management system for the project. It consisted of a database with two tables, one thats called on for the home page and the other is called on for dynamic content page using the tables primary keys.

- PHP --> 
- JavaScript --> 
- Libraries --> 
- HTML & CSS -->
 
