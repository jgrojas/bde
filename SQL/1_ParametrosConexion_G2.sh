# Por favor suministre sus datos de conexion aqui
export PGPORT=5432
export PGHOST=bde2020.cpzvmgzzg0iz.us-east-2.rds.amazonaws.com
export PGUSER=postgres
export postgres=postgres
export PGBIN=/usr/lib/postgresql/12/bin

# cd to path of the shell script
cd "$( cd "$( dirname "$0" )" && pwd )" > /dev/null

# Run create_tables_g2.sql to create the 3D City Database instance
"$PGBIN/psql" -d "$postgres" -f "create_tables_g2.sql" #-password "XXUU$/"·&BDsa"
"$PGBIN/psql"-d "$postgres" -f "table_agencianave_g2.sql"

