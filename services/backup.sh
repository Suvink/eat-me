TIMESTAMP=`date +%Y-%m-%d_%H-%M-%S`
echo "SQL DUMP STARTED AT ${TIMESTAMP}"
touch "../backups/Backup-${TIMESTAMP}.sql"
/Applications/XAMPP/bin/mysqldump --user=eatme --password=weM2KxUZriR9 --host=localhost eat_me > ../backups/Backup-${TIMESTAMP}.sql
echo "BACKUP FINISHED"