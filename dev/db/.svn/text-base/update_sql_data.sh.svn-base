#!/bin/bash
$2dev/db/print_sql_initial.sh $1 $2 $3 $4 $5 > $2dev/db/temp_update_db.sql
$6mysql -h $7 -u $8 -p$9 $1 < $2dev/db/temp_update_db.sql 
rm $2dev/db/temp_update_db.sql
