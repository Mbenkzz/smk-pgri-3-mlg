```
├── app                           # Main MVC file structure directory
│   ├── controllers               # Controllers directory
│   ├── models                    # Models directory
│   └── views                     # Views directory, 
├── core                          # Basically mvc engine directory
│   ├── app.php                   # Main framework file
│   ├── classes                   # Classes directory for possible autoloading
│   │   ├── controller.php        
│   │   └── model.php             
│   ├── config                    # Configuration directory
│   │   ├── database.php          
│   │   ├── session.php           
│   │   ├── config.php            # First file you must edit it
│   │   ├── routes.php            # URI Route for this website
│   │   └── session.php           
│   └── helpers                   # Autoloaded helpers directory
│       └── function_helper.php     
├── index.php                     # Endpoint url
├── public                        # Directory for all public resources, javascript files, stylesheets and vendor plugins
│   ├── javascripts               
│   ├── stylesheets               
│   └── vendor                    
└── .htaccess                     # htaccess rewriting all of requests to MVC endpoint /index.php
```
