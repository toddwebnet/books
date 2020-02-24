# James Todd
toddwebnet@gmail.com
361-482-6438

so, I met most of the requirements.  I could keep going and going on this, but this started eating up a bunch of time.
for the purpose of this exercise I believe I have meet your needs (seeing how I program and my style)
other things I could have done
 - expanded more on the unit tests for the service class (especially that gnarly sql to get max and total sales - I chose this path for better efficiency instead of compiling all this in php code. debates could be had on this topic)
 - allowed for adding a new edition
 - allowed for the adding of a new book
 
 this may not have been the best approach for such a tool, but it is simple and effective.  It is better to collaborate as a team on the architecture decisions, but this is a first stab,

to setup hosting, I used Vagrant.  I build a vagrant framework to easily stand up stuff

https://bitbucket.org/toddwebnet2/vagrant

I have oracle virtualbox and vagrant installed.

config.yaml for vagrant should look like:

servers:
- projects:
  - ip: "192.168.200.15"
  - folders:
    - map: /home/user/projects
      to: /home/vagrant/www
  - features:
      - lamp      
  - sites:
      - adminer.local.com
      - books.local.com

will need to also install plugins
vagrant plugin install vagrant-vbguest
vagrant plugin install vagrant-winnfsd
vagrant plugin install vagrant-hostsupdater


once that is setup, this project should be in the same root folder of vagrant

/home/user/projects/vagrant
/home/user/projects/books
(project folder name must be books)


update your .env file
inside this project you can find the sql credentials
./vagrant/create.sql (or you can use username: "root" password "password")


or ... 

if you don't want that route. 
you could change the driver to sqllite or have a mysql server setup somewhere
and use
php artisan serve


# 39dg-challenge

Book Inventory App

Create a Laravel app that allows a user to perform CRUD operations on a book inventory system. 

Tech stack:

- Laravel 5.5 LTS
- Bootstrap 3.*
- React 15.*

Books:

- A book may have multiple editions;
- Each book edition must have a unique SKU;
- Each book edition may have its own price;

Index page:

- List books grouped by best-seller edition - i.e. do not show different editions of the same book, 
    only the one with the most sales.
- Display the Title, Total available quantity (all editions), Total sold quantity (all editions), 
    price (specific to the listed edition) for each book;
- Provide links to Edit and Delete features;

Show page:

- Display sales history with price at the time of purchase, timestamps, total income amount and total sales;
- Sales history must have Add and Delete features to simulate users buying the book;
- Display a separate list of the other editions of the book being shown, with the same information and CRUD features provided in the "index" page;

Edit page:

- Change book name;
- Change available book quantity;
- Change the book price (no book should have a price of zero)
- Button to add edition (new book);

Requirements:

- Use Laravel Framework 5.5 or above.
- Do not use libraries or external modules besides the ones that come 
  with Laravel. 
- Create migrations and seeders (At least 10 books with up to 3 editions, each edition with up to 5 items sold - use random data); 
- Documentation and comments. 
- In the README of the project you must include your name, email, 
  installation instructions in order for us to test your implementation,
  configuration, test execution, and any other information you feel is relevant.
  If you're not able to complete the test, tell us what you would do if you had more time.

Plus:

- Create and reuse react components (not SPA);
- Implement tests with PHPUnit;
- Use all the Laravel features you know. The more the better. Really, do show off!
