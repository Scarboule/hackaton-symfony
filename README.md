# Symfony Project - Ski Resort 
This project is a website for ski resorts where users can view information on ski resorts and their respective domains. Users can view information about ski lifts, their schedules, ski runs, their difficulty levels, and filter them by difficulty. They can also view weather information for each ski resort.

### Installation
To install this project, follow these steps in your cmd prompt:  

Clone this repository:  
```git clone https://github.com/Arthur-Prudhomme/hackaton-symfony``` 

Move into the project directory:  
```cd hackathon-symfony```  

Install dependencies:  
```composer install```  

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