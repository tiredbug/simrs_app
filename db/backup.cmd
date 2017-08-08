for /f "tokens=2-4 delims=/ " %%a in ('date /T') do set year=%%c
for /f "tokens=2-4 delims=/ " %%a in ('date /T') do set month=%%a
for /f "tokens=2-4 delims=/ " %%a in ('date /T') do set day=%%b
 
for /f "tokens=1 delims=: " %%h in ('time /T') do set hour=%%h
for /f "tokens=2 delims=: " %%m in ('time /T') do set minutes=%%m
for /f "tokens=3 delims=: " %%a in ('time /T') do set ampm=%%a
 
rem membuat file backup database dengan format nama_database-tahun-bulan-hari_jam_menit
set FILE_BACKUP=C:\xampp\htdocs\simrs_app\db\backup\simrs_app-%year%-%month%-%day%_%hour%-%minutes%-%ampm%
 
set path=C:\xampp\mysql\bin
rem USER_NAME, USER_PASSWORD dan NAMA_DATABASE menyesuaikan
mysqldump -uroot  --routines simrs_app > %FILE_BACKUP%.sql