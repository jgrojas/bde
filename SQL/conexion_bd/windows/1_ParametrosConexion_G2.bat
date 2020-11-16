REM Por favor suministre sus datos de conexion aqui
set PGPORT=5432
set PGHOST=your_host_name
set PGUSER=your_user_name
set SIMARDB=your_database
set PGBIN=C:\Program Files\PostgreSQL\12\bin
set PGPASSWORD=your_password

REM cd to path of the shell script
cd /d %~dp0

REM Run create_tables_g2.sql to create bd simar instance
"%PGBIN%\psql" -d "%SIMARDB%" -f "create_tables_g2.sql" 
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_agencianave_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_tiponave_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_paises_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_nave_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_nave_agencianave_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_categoria_pnn_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_pnn_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_capitanias_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_puertos_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_razon_arribos_g2.sql"
"%PGBIN%\psql" -d "%SIMARDB%" -f "table_arribos_naves_puertos_g2.sql"

pause