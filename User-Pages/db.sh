[kphonasa@serv42 hw3]$ more db.sh
#!/bin/sh

# Change DBPASSWORD, DBUSER, DBHOST and DBNAME to match the values
# your mysql_db_info file on the webdev server.
mysql --password='MT_G.noQxVHv' --user='kphonasa' --host='dbdev.cs.uiowa.edu' 'db_kphonasa'