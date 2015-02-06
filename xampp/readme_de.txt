  ApacheFriends XAMPP (basic package) version 1.5.4a

  + Apache 2.2.3
  + MySQL 5.0.24a
  + PHP 5.1.6 + PHP 4.4.4 + PEAR
  + PHP-Switch win32 1.0 (von Apachefriends, man nehme die "php-switch.bat") 
  + XAMPP Control Version 2.3 from www.nat32.com	
  + XAMPP Security 1.0	
  + SQLite 2.8.15
  + OpenSSL 0.9.8d
  + phpMyAdmin 2.9.0.1
  + ADOdb 4.91
  + Mercury Mail Transport System v4.01b
  + FileZilla FTP Server 0.9.18
  + Webalizer 2.01-10
  + Zend Optimizer 3.0.1
  + eAccelerator0.9.5 RC1 f�r PHP 5.1.6 (auskommentiert php.ini)
 
* System Vorrausetzungen:
  
  + 64 MB RAM (recommended)
  + 200 MB free Fixed Disk 
  + Windows 98, ME
  + Windows NT, 2000, XP (Recommended)

SCHNELLINSTALLATION:

[Schritt 1: Auf die obersten Hirachie eines beliebigen Laufwerks bzw. 
auf dem Wechseldatentr�ger des USP Sticks entpacken => E:\ oder W:\. Es 
entsteht E:\xampp oder W:\xampp. F�r den USB Stick nicht die 
"setup_xampp.bat" nutzen, um ihn auch transportabel nutzen zu k�nnen!]

Schritt 1: Das Setup mit der  Datei "setup_xampp.bat" im XAMPP Verzeichnis 
starten.Bemerkung: XAMPP macht selbst keine Eintr�ge in die Windows Registry
und setzt auch keine Systemvariablen.   

Schritt 2: Apache2 mit PHP4 starten mit
=> \xampp\apache_start.bat
Der Apache 2 wird durch einfaches schlie�en der 
Apache Kommandoforderung (CMD) heruntergefahren. 

Schritt 3: MySQL starten der mit 
=> \xampp\mysql_start.bat
Den MySQL regul�r stoppen mit "mysql_stop.bat".

Schritt 4: �ffne deinen Internet Browser und gebe http://127.0.0.1
oder http://localhost ein. Danach gelangst du zu den zahlreichen 
ApacheFriends Beispielen auf deinem lokalen Server.

Schritt 5: Das Hauptdokumentenverzeichnis f�r HTTP (oft HTML) ist
=> \xampp\htdocs. PHP kann die Endungen  *.php, *.php4,
*.php3, *.phtml haben, *.shtml f�r SSI, *.cgi f�r CGI (z.B. perl).

Schritt 6: XAMPP DEINSTALLIEREN? Einfach das "xampp" 
Verzeichnis l�schen. Vorher aber alle Server stoppen 
bzw. als Dienste  deinstallieren. 

---------------------------------------------------------------
PASSW�RTER

1) MySQL

Benutzer: root
Passwort:
(also kein Passwort)

2) FileZilla FTP

Benutzer: newuser
Passwort: wampp 

Benutzer: anonymous
Passwort: some@mail.net

3) Mercury: 
Postmaster: postmaster (postmaster@localhost) und Admin (Admin@localhost)

Testuser: newuser  
Passwort: wampp 

4) WEBDAV: 

Benutzer: wampp
Password: xampp 

---------------------------------------------------------------
NUR F�R NT SYSTEME
(NT4 | windows 2000 | windows xp)

\xampp\apache\apache_installservice.bat =
==> Installiert des Apache 2 als Dienst

\xampp\apache\apache_uninstallservice.bat =   
==> Deinstalliert des Apache 2 als Dienst

\xampp\mysql\mysql_installservice.bat =
==> Installiert MySQL als Dienst

\xampp\mysql\mysql_uninstallservice.bat = 
==> Deinstalliert MySQL als Dienst

==> Nach allen Dienst(de)installationen, system neustarten! 
---------------------------------------------------------------

DAS THEMA SICHERHEIT

Wie schon an anderer Stelle erw�hnt ist XAMPP nicht f�r den Produktionseinsatz gedacht, 
sondern nur f�r Entwickler in Entwicklungsumgebungen. Das hat zur Folge, dass XAMPP 
absichtlich nicht restriktiv sondern im Gegenteil sehr offen vorkonfiguriert ist. F�r 
einen Entwickler ist das ideal, da er so keine Grenzen vom System vorgeschrieben bekommt. 
F�r einen Produktionseinsatz ist das allerdings �berhaupt nicht geeignet.Hier eine Liste, 
der Dinge, die an XAMPP absichtlich(!) unsicher sind:

Der MySQL-Administrator (root) hat kein Passwort. 
Der MySQL-Daemon ist �bers Netzwerk erreichbar. 
phpMyAdmin ist �bers Netzwerk erreichbar. 
In dem XAMPP-Demo-Seiten (die man unter http://localhost findet) gibt es den Punkt "Sicherheitscheck". 
Dort kann man sich den aktuellen Sicherheitszustand seiner XAMPP-Installation anzeigen lassen.

Will man XAMPP in einem Netzwerk betreiben, so dass der XAMPP-Server auch von anderen 
erreichbar ist, dann sollte man unbedingt den folgende URL aufrufen, mit dem man 
diese Unsicherheiten einschr�nken kann: 

http://localhost/security/

Hier kann das root Passwort f�r MySQL + phpMyAdmin und auch ein Verzeichnisschutz f�r die 
XAMPP-Seiten eingerichtet werden. 


Apache Hinweise:

(1) Im Gegesatz zu dem Apache 1.x kann der Apache 2 bei 
einen manuellen Start nicht mit "apache -k shutdown" gestoppt
werden. Das funktioniert nur als Dienstinstallation unter 
NT Systemen. Also die Apache START Eingabeforderungen zum stoppen 
einfach schlie�en.


(2) F�r mod_auth_mysql experimentell. Das Modul ebenfalls einfach
in der "httpd.conf" entkomentieren. Weitere Hinweise zu diesem Modul 
findet Ihr auf der Hauptseite dieses Xampp-Pakets.   


(3) Zum laden von Web_DAV nur die Module 
mod_dav.so + mod_dav_fs.so in der httpd.conf entkommentieren 
(# entfernen). Dann f�r http://127.0.0.1:81 einrichten und testen!
(nicht f�r MS Frontpage, einzig f�r Adobe Dreamweaver)


MYSQL Hinweise:

1) Um den mysqld zu starten bitte Doppelklick auf \xampp\mysql_start.bat. 
Der MySQL Server startet dann im Konsolen-Modus. Das dazu geh�rige 
Konsolenfenster muss offen bleiben (!!) Zum Stop bitte die mysql_shutdown.bat 
benutzen!

2) Um den MySQL Daemon von diesem Paket mit "innodb" f�r bessere Performance zu
nutzen, editiert bitte die "my" bzw."my.cnf" im /xampp/mysql/bin Verzeichnis
bzw. als Dienst die C:\my.cnf unter NT/2000/XP. Dort akiviert ihr dann die Zeile
"innodb_data_file_path=ibdata1:30M". Achtung, "innodb" kann ich derzeit nicht
f�r 95/98/ME empfehlen, da es hier immmer wieder zu blockierenden 
Systemen kam. Also nur NT/2000/XP!  

Wer MySQL als Dienst unter NT/2000/XP benutzen m�chte, muss 
unbedingt (!) vorher die "my" bzw."my.cnf unter c:\ (also c:\my.cnf) 
implementieren. Danach die "mysql_installservice.bat" im mysql-Ordner 
aktivieren.  		 	


3) Der MySQL-Server startet ohne Passwort f�r MySQl-Administrator "root". 
F�r eine Zugriff in PHP s�he das also aus:  
mysql_connect("localhost","root","");
Ein Passwort f�r "root" k�nnt ihr �ber den mysqladmin in der Eingabforderung
setzen. Z.B: 
    \xampp\mysql\bin\mysqladmin -u root password geheim
Wichtig: Nach dem einsetzen eines neuen Passwortes f�r root muss auch 
phpMyAdmin informiert werden! Das geschieht �ber die Datei "config.inc.php"
zu finden als \xampp\phpmyadmin\config.inc.php. Dort also folgenden 
Zeilen editieren:  
   
    $cfg['Servers'][$i]['user']            = 'root';   // MySQL user
    $cfg['Servers'][$i]['auth_type']       = 'http';   // HTTP Authentifzierung

So wird zuerst das 'root' Passwort vom MySQL Server abgefragt, bevor
phpMyAdmin zugreifen darf.  	
    
---------------------------------------------------------------	
    
Have a lot of fun! Viel Spa�! Bonne Chance!
 