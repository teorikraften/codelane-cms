## Code Lane CMS
### Innehåll
* 1 Komma igång
  * 1.1 Servermiljö
  * 1.2 Laravel
  * 1.3 Repot
  * 1.4 Fråga
  * 1.5 Databas
  * 1.6 Er miljö så att det funkar

### 1 Komma igång
#### 1.1 Servermiljö
För att komma igång med Laravel och PHP måste man ha en servermiljö installerad. För Windows finns till exempel [Wamp](http://www.wampserver.com/en/), för Mac finns [Mamp](http://www.mamp.info/en/) och för Linux finns för till exempel Ubuntu [Lamp](https://help.ubuntu.com/community/ApacheMySQLPHP). Det viktiga är att ni har Apache eller liknande server, som kör PHP och MySQL. Googla typ "Apache PHP MySQL [din_plattform]" så lär ni hitta något. Annars kan ni ju också fråga mig. Ett hett tips som nästan är obligatoriskt är att installera [phpMyAdmin](http://www.phpmyadmin.net/home_page/index.php). Det gör att ni får ett grafiskt gränssnitt till databasen. Enklare att installera nya databasversioner osv.

#### 1.2 Laravel
När det är gjort kan ni installera Laravel om ni vill. Det är inget krav för att kunna programmera i projektet tror jag, men om man till exempel vill ändra strukturen på databasen behövs det (migrations laravel, bra fras att googla då). [Här finns en bra guide.](http://laravel.com/docs/5.0/installation)

#### 1.3 Repot
När ni har installerat en servermiljö lär ni kunna nå den via http://localhost. Efter installationen är klar, eller innan, clonea det här git-repot till någonstans på er dator, tex i mappen www som är root för servern. Skapa sedan ett nytt virtual host i Apache (googla eller [följ den här guiden för Windows](http://foundationphp.com/tutorials/apache_vhosts.php)). Det viktiga är att rooten för den nya virual hosten är mappen public i det här repot. 

#### 1.4 Fråga
Eller bara fråga mig (Dahl (Jonas)) så kan jag titta på det eller förklara. Jag kom på att om jag skriver så så slipper jag skriva så mycket.

#### 1.5 Databas
Efter detta, och detta måste göras varje gång databasen uppdaterats, ni lär bli varse, så måste ni ta databasen database.sql som ligger i rooten och importera till er databas, till exempel med hjälp av phpMyAdmin eller Terminalen. 

#### 1.6 Er miljö så att det funkar
När ni har gjort allt det här måste ni öppna filen kopia.env.php och följa instruktionerna i den. Detta för att alla har olika uppgifter till databasen. Det är schysst om ni inte ändrar i kopia.env.php utan bara kopierar den, så slipper vi merge conflicts osvosv.
