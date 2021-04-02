Benodigde Software:
- Code editor die PHP ondersteund
- Postman
- XAMPP
- MySQL Versie 10.4.17-MariaDB
- PHP Versie 8.07

Stappenplan:
1. Pull de Github zodat alle laatste bestanden aanwezig zijn in: "C:\xampp\htdocs\dataprocessing"

2. Om het SlimFramework werkend te krijgen is er een tweetal aanpassingen nodig aan bestanden.
2.1 Ga naar: "C:\xampp\apache\conf\extra" open het bestand "httpd-vhosts.conf".
Zorg dat dit bestand gelijk is aan het bestand "C:\xampp\htdocs\dataprocessing\README\httpd-vhosts.conf".
Het gaat er hier bij om dat regels 20 en regels 44 tot en met 53 van "C:\xampp\htdocs\dataprocessing\README\httpd-vhosts.conf" moeten bestaan in "C:\xampp\apache\conf\extra\httpd-vhosts.conf"
2.2 Ga naar "C:\Windows\System32\drivers\etc". Open hier het bestand "hosts.conf" met een teksverwerker die toegang heeft tot administrator rechten "Studio Code".
Voeg in dit bestand tussen de regels "127.0.0.1 localhost" en "::1 localhost" een nieuwe lijn toe. Zorg dat deze lijn gelijk is aan "127.0.0.1 localhost" verander "localhost" echter in "API".

3. Open XAMPP zet de Apache en MySQL module aan.

4. Navigeer naar "api/phpmyadmin" of "localhost/phpmyadmin". Importeer hier het .sql bestand dat op locatie "C:\xampp\htdocs\dataprocessing\README\DATABASE" staat.

5. Open POSTMAN en importeer het viertal .postman_collection.json bestanden uit map "C:\xampp\htdocs\dataprocessing\README\Postman Collections".

6. Vanuit Postman kan de API nu gebruikt worden. De collection "DELETE" wordt aangedreven door een "ID" mee te geven welke linkt naar de Database.
Collection "GET" wordt enkel op het "ID" aangedreven bij requests waar /1 achter staat. Alle overige GET requests geven alle resultaten van de database weer.
Collection "POST" wordt niet aangedreven op "ID", hier wordt gekeken naar de "body" van Postman en dit wordt als nieuwe row in de database aangemaakt.
Collection "PUT" kijkt net als "POST" naar de inhoud van de "body" van Postman, echter wordt deze wel aangedreven door een "ID". 
De row met het corresponderende "ID" wordt veranderd naar de inhoud van de "body" in Postman.

7. De code voor de API staat in .php bestanden op locatie "C:\xampp\htdocs\dataprocessing\API\app\api"

8. Om de GUI te testen navigeer in de browser naar: api/homepage.php