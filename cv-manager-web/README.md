# CV Management Application

## Overview
This application is designed for managing and displaying Curriculum Vitae (CV) data. It features a front-end built with Vue.js, Vuex, and Vuetify, and a back-end developed using PHP Laravel. The application allows users to create, edit, view, and download CVs, with data stored in a MySQL database.

## Prerequisites
Before setting up the project, ensure you have the following installed:

* PHP (version 8.2.12 or higher)
* Composer (Dependency Manager for PHP)
* XAMPP (for MySQL and PHPMyAdmin)
* Node.js and npm (for Vue.js)
* Laravel (version 10.30.1 or higher)

## Installation

#### 1. Clone the Repository:

```
git clone https://github.com/artursbridaks/cv-manager.git
```

#### 2. Navigate to "cv-manager-api" Folder:

```
cd cv-manager-api
```

#### 3. Install PHP Dependencies:

```
composer install
```

#### 4. Database Migration:

```
php artisan migrate
```

#### 5. Start the Back-End Server:

```
php artisan serve
```

#### 6. Navigate to "cv-manager-web" Folder:

```
cd..
```

And:

```
cd cv-manager-web
```

#### 7. Install Node Modules:

```
npm install
```

#### 8. Launch the Front-End:

```
npm run serve
```

#### 9. Open XAMPP: 

Start the "Apache" and "MySQL" actions.

#### 10. Install and Open phpmyadmin Dashboard (Optional):

* Install from here: https://www.phpmyadmin.net/downloads/
* Open here: http://localhost/phpmyadmin/index.php

## Features

* CV Listing: View a list of all entered CVs with options to edit, delete, or add new CVs.
* CV Editor: A dedicated interface for adding or updating CV information.
* CV Viewer: Display CV data in a print-ready format.
* CV Downloader: Download the CV in PDF format.

## Database Structure

* Basic Information: Name, Surname, Email, Phone.
* Employment: Company, Role, Type, Experience, Achievements, Additional skills.
* Education: School, Faculty, Course, Degree, Status.
* Addresses: Country, City, Street, Number, Index.

## Future Improvements

While the current version of the application serves as a functional prototype, there are several areas identified for improvement.

#### Comprehensive Field Validations: 

Validation rules for all input fields would ensure data integrity and enhance user experience.

#### Enhanced Error Handling:

Developing a more sophisticated error handling mechanism will improve the application's stability and user experience.

#### UI and UX Enhancements:

Refining the UI/UX design to be more intuitive and visually appealing. This could involve revisiting the layout, color schemes.

#### Performance Optimization: 

Focusing on front-end and back-end performance optimizations to ensure faster load times and smoother interactions, especially for data-heavy operations.