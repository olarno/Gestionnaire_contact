# Mise en place 

- Apres clonage du depot

Pensez à créer un fichier .env.local (pour acces a la bdd)

>A la racine du projet symfony   
```touch .env.local```  
>Dans le fichier .env.local   
``` DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7 ```

- Création de la base de données :

> ```bin/console d:b:c```

- Appliquer les migrations : 

*lastVersion : Version20200329143725.php*

> ```bin/console d:m:m```