# Por favor suministre sus datos de conexion aqui
export PGPORT=5432
export PGHOST=bde2020.cpzvmgzzg0iz.us-east-2.rds.amazonaws.com
export PGUSER=postgres
export SIMARDB=postgres
export PGBIN=/usr/lib/postgresql/12/bin
export PGPASSWORD=GoXA6LbecbxuZ4ipix9H

# cd to path of the shell script
cd "$( cd "$( dirname "$0" )" && pwd )" > /dev/null

# Run create_tables_g2.sql to create bd simar instance
"$PGBIN/psql" -d "$SIMARDB" -f "create_tables_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_agencianave_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_tiponave_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_paises_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_nave_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_nave_agencianave_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_categoria_pnn_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_pnn_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_capitanias_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_lineacosta_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_puertos_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_razon_arribos_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_arribos_naves_puertos_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_grilla_caribe_g2.sql"
"$PGBIN/psql" -d "$SIMARDB" -f "table_oleaje_g2.sql"

