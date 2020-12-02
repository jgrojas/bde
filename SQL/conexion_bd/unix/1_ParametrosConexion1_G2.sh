# Por favor suministre sus datos de conexion aqui
export PGPORT=5432
export PGHOST=your_host_address
export PGUSER=your_username
export SIMARDB=your_database
export PGBIN=path_to_pgsql.exe
export PGPASSWORD=your_password

# cd to path of the shell script
cd "$( cd "$( dirname "$0" )" && pwd )" > /dev/null

# Run create_tables_g2.sql to create bd simar instance
"$PGBIN/psql" -d "$SIMARDB" -f "table_arribos_naves_puertos2_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "vistas_simar_g2.sql"

