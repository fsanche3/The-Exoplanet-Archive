# The-Exoplanet-Archive(Full Stack)
### Table of Contents
- [Description](#description)
- [Stack](#stack)
- [How To Use](#how-to-use)
- [Experiences](#Experiences)
- [Link](#link)
- [API & Data Sources](#API-&-Data-Sources)

## Description

The Exoplanet Archive was created to retrieve and present automated confirmed exoplanet discoveries from NASA's exoplanet API. The main idea behind it was to present the data in a simple manner with the help of data visualization. I thought of this idea while watching a video on an exoplanet discovery and found myself wanting to get a better idea of where the planet is relative to its sun. Today I refer to this website when I encounter new discoveries and using the Tableau comparisons dashboard helps me build a mental image of the exoplanet and its properties.

## Stack
- Golang --> Golang was used to make the http API request and mirror the JSON data into a slice consisting of exoplanet structs with its relative properties. It was also used to connect and insert the data into the mysql database table hosted by Suny Oswego's University servers. Lastly it implemets a time() function which calles the API request periodically.

- MySql --> This was the database management system for the project. It consisted of a database with two tables, one thats called on for the home page and the other is called on for dynamic content page using the tables primary keys.

- PHP --> This was used to connect to the database from the server side and present it into a jquery datatable. PHP/SQL queries were written for both tables and the dynamic content relied on the exoplanet ID to present it's individual page. The queries were also written for pagination for faster load time of a large dataset.

- Tableau --> I used the a seperate dataset of planets within our solar system and presented them on a dashboard that I specifically created for this project. The dashboard can be used to compare the exoplanet properties with planets in our own solar system.

- JavaScript --> The creation of the timed slideshow using a interval function and a counter. 

- Libraries --> Jquery-Ajax, Bootstrap, and datatable libraries.

- HTML & CSS --> CSS Grid, Animted star rush background.
 
 ## How To Use
A user can get the most out of this website by selecting an exoplanet of interest from the datatable. After being redirected to the dynamic content page, the selected exoplanets properties can be compared the properties of planets in our own solar system using the interactive graph provided. These instructions can also be found on the about page.

## Experiences
This project took me two months. I learned a few lessons such as working on a mobile design first and different alternative libraries that could have been used. This was also the first project I was able to implement Golang and Tableua. Challenging myself with those learning curves was very pleasing and Im excited to implement Golang for other Full Stack projects seeing how effective it can be. 

## Link 
 - cs.oswego.edu/~fsanche3/exo/

## API & Data Sources
- Http request --> "https://exoplanetarchive.ipac.caltech.edu/TAP/sync?query=select+pl_name,sy_dist,disc_year,discoverymethod,disc_telescope,pl_orbper,pl_radj,pl_masse,pl_orbeccen,sy_mnum,pl_rade,pl_massj,pl_dens,disc_facility+from+ps&format=json"
- The Solar System bodies data set was recovered from Kaggle.com.
