# disharzz

Eine Digezzprojekt-Sharing Plattform für das Modul Interaktive Medien 3.
Schwerpunkt dieses Moduls war Backend Technologien mit PHP.

## Live Beispiel

Ein Live Beispiel findest du [Hier](https://185457-1.web.fhgr.ch/)


## Konfiguration

Kopiere die Datei ['db_empty.php'](./class/db_empty) im Verzeichnis ['class'](./class) zu db.php
Hier werden die MySQL oder MariaDB Credentials angegeben. 
```javascript
    private $db_username = 'user'; // Benutzername
    private $db_password = 'password'; // Passwort
    private $db = 'host'; // IP der Datenbank
    private $db_name = 'database'; // Name der Datenbank
    private $db_port = '3306'; // Port
```

Auf deiner Datenbank dann den ['Datenbank Dump'](./init.sql) in deiner Datenbank importieren.


## Lokale Dev Umgebung

Wenn du Docker installiert hast einfach im Root Verzeichnis in der ['Docker Konfiguration'](./docker-compose.yml) deine Passwort für MariaDB setzen, dieses in deiner db.php einfügen und in der Konsole docker-compose up durchführen. Nun hast du 3 Services gestartet (Apache mit php8 / MariaDB / phpmyadmin)

Mit phpmyadmin eine Datenbank erstellen und den ['Datenbank Dump'](./init.sql) importieren.

## Deploy

1. Auf deinem Server eine Datenbank erstellen
2. ['Datenbank Dump'](./init.sql) importieren
3. die db.php im ordner ['class'](./class) entsprechend anpassen
4. Alles auf deinen Webserver laden.
