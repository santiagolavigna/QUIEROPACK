@echo off
cls
C:\xamp\mysql\bin\mysqldump -u root -p quieropack > quieropack.sql
C:\xamp\mysql\bin\mysqldump -u root -p quieropack_bolsas > quieropack_bolsas.sql