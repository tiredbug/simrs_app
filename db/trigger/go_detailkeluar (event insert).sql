
DROP TRIGGER IF EXISTS insert_tabel_detail_keluar;

delimiter //

CREATE TRIGGER insert_tabel_detail_keluar AFTER INSERT ON go_detailkeluar
FOR EACH ROW
BEGIN

-- update jumlah keluar pada tabel detail masuk, secara otomatis menjalankan event trigger update tabel detail keluar
UPDATE go_detailmasuk SET jumlah_keluar=jumlah_keluar+NEW.jumlah_keluar, stok=stok-NEW.jumlah_keluar WHERE id=NEW.id_barangmasuk;


END;//
delimiter ;