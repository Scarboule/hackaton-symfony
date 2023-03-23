# Symfony Project - Ski Resort 
This project is a website for ski resorts where users can view information on ski resorts and their respective domains. Users can view information about ski lifts, their schedules, ski runs, their difficulty levels, and filter them by difficulty. They can also view weather information for each ski resort.

### Requirements
- PHP (8.1.11 or higher)
- Symfony CLI (5.4.21 or higher)
- Composer
- Database (We use laragon and MySQL in our project)

### Installation
To install this project, follow these steps in your cmd prompt:  

Clone this repository:  
```git clone https://github.com/Arthur-Prudhomme/hackaton-symfony``` 

Move into the project directory:  
```cd hackathon-symfony```  

Install dependencies:  
```composer install```  

Set the local environement :  
Run your database server.  
Copy the ```.env``` file and past it at the same place, rename it ```.env.local```.  
Open it and remove the ```#``` before the method you wish to use to create the database and then put your db infos like this :  
```
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
DATABASE_URL="mysql://DB_USER:DB_PASSWORD@127.0.0.1:3306/DB_NAME?serverVersion=8&charset=utf8mb4"
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
```
Replace ```DB_USER```, ```DB_PASSWORD``` and ```DB_NAME``` by yours.

Set up the database:  
```php bin/console doctrine:database:create```  
and  
```php bin/console doctrine:migrations:migrate```  


Load tests data :  
```php bin/console doctrine:fixture:load```  

Start the server:   
```symfony serve```

### Usage
Open your web browser and go to the following URL: http://127.0.0.1:8000/

You can browse through the different ski resorts and their respective domains, view information on ski lifts and ski runs, filter ski runs by difficulty level, and view weather information for each ski resort.  
Users are able to log in as ski resort admin, or domain admin. 

### Authors
[Arthur Prud'homme](https://github.com/Arthur-Prudhomme), [Lucie Ehrsam](https://github.com/Elicue), [Théa Blachon](https://github.com/EthraDev), [Lucas Charoing](https://github.com/lucaschrng), [Oscar Dartigues](https://github.com/Scarboule).