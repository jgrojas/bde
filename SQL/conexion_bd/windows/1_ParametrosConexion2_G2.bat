REM Por favor suministre sus datos de conexion aqui
set PGPORT=5432
set PGHOST=your_host_address
set PGUSER=your_username
set SIMARDB=your_database
set PGBIN=path_to_pgsql.exe
set PGPASSWORD=your_password

REM cd to path of the shell script
cd /d %~dp0

REM Run create_tables_g2.sql to create bd simar instance
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_arribos_naves_puertos3_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "vistas_simar_g2.sql"

pause