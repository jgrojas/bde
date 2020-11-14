REM Por favor suministre sus datos de conexion aqui
set PGPORT=5432
set PGHOST=bde2020.cpzvmgzzg0iz.us-east-2.rds.amazonaws.com
set PGUSER=postgres
set postgres=postgres
set PGBIN=C:\Program Files\PostgreSQL\12\bin

REM cd to path of the shell script
cd /d %~dp0

REM Run create_tables_g2.sql to create the 3D City Database instance
"%PGBIN%\psql" -d "%postgres%" -f "create_tables_g2.sql"
"%PGBIN%\psql" -d "%postgres%" -f "table_agencianave_g2.sql"

pause