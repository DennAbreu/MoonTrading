<div align="center"><img src="assets\MT2.png"></div>
<h1 align="center">Moon Trading</h1>
<p align="center"><strong>A Project for Brooklyn College's CISC 4900</strong></p>

<div align="center"><a href="https://www.youtube.com/watch?v=JfhS5jCowzM" target="_blank">Click to see a demo!</a></div>

<h2>About</h2>
Moon Trading is a user friendly	paper-trading platform where users can create a portfolio with real stock data from <a href="finnhub.io">Finnhub.io's</a> public stock APIs. This portfolio will provide the user with several metrics to help educate them on future financial moves.

<h2>Goals and Requirements</h2>

My main goal was to learn the basics of web development while researching a topic that I was interested in. I chose to create a paper-trading website in order to provide users with a free and safe way to practice and experiment with trading. With MoonTrading users are able to buy or sell (using fake currency) stocks and monitor the growth of their portfolios.

<h2>Key Learnings</h2>

- Designing and deploying a website.
- Login & form validation.
- Working with and fetching data from public APIs through user's search input.
- Writing & retrieving data from a local MySQL database.
- The concepts and basic implementation of a relational database.
- Working with 'sessions' in PHP to validate user logins.

<h2>Built With</h2>

| Package                                                  | Docs                                                                           |
| -------------------------------------------------------- | ------------------------------------------------------------------------------ |
| [HTML](https://www.w3schools.com/html/)                  | [:notebook: Click Me](https://www.w3schools.com/html/)                         |
| [CSS](https://developer.mozilla.org/en-US/docs/Web/CSS)  | [:notebook: Click Me](https://www.w3schools.com/cssref/default.asp)            |
| [JavaScript ES6](https://www.javascript.com/)            | [:notebook: Click Me](https://developer.mozilla.org/en-US/docs/Web/JavaScript) |
| [JQuery](https://jquery.com/)                            | [:notebook: Click Me](https://api.jquery.com/)                                 |
| [PHP](https://www.php.net/)                              | [:notebook: Click Me](https://www.php.net/manual/en/)                          |
| [MySQL(XAMPP)](https://www.apachefriends.org/index.html) | [:notebook: Click Me](https://www.apachefriends.org/faq_windows.html)          |

<h2>Project status</h2>
Project is complete as per the requirements of Brookyln College's CISC 4900. I am planning on rewriting and improving this project with frameworks such as React in the future.

<h2>Getting Started</h2>

To get a local copy running on your machine please follow the steps below:

1. Download this project as a zip file.
2. Download <a href="https://www.apachefriends.org/download.html">XAMPP local MySQL database</a>.
3. Navigate to the folder where XAMPP is installed and unzip project files in '/htdocs'.
   <br>Example:

```sh
C:\xampp\htdocs\...
```

4. In the XAMPP Control Panel start the Apache & MySQL actions.
5. In your browser navigate to <a href='http://localhost/phpmyadmin/'>http://localhost/phpmyadmin/<a>
6. On the PHPMyAdmin console click on 'import' > 'Browse Your Computer' under 'File to Import', and then select the cisc4900.sql file in the assets folder.

```sh
C:\xampp\htdocs\MoonTrading-main\MoonTrading-main\assets\cisc4900.sql
```

6. In the XAMP Control Panel, click on 'Admin' for the Apache module OR navigate to 'http://localhost/MoonTrading-main/MoonTrading-main/' in your browser.

<h2>Credits</h2>

- Author: <a href="https://www.linkedin.com/in/dennabreu/" target="_blank">Dennis Abreu</a>
- Graphics: <a href="https://www.linkedin.com/in/dennabreu/" target="_blank">Dennis Abreu </a>

<h2>Copyright</h2>
This project is licensed under the terms of the MIT license and protected by Udacity Honor Code and Community Code of Conduct. See <a href="LICENSE.md">license</a> and <a href="LICENSE.DISCLAIMER.md">disclaimer</a>.
