-- Este script es llamado desde el archivo 1_ParametrosConexion.bat
\pset footer off
SET client_min_messages TO WARNING;
\set ON_ERROR_STOP ON

--// create TABLES, SEQUENCES, CONSTRAINTS, INDEXES
\echo
\echo 'Configurando el esquema de la base de datos'
\i create_tables_g2.sql

table_agencianave_g2.sql
