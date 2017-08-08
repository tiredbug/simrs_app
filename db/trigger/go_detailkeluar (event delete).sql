
DROP TRIGGER IF EXISTS delete_tabel_detail_keluar;

delimiter //

CREATE TRIGGER delete_tabel_detail_keluar AFTER DELETE ON go_detailkeluar
FOR EACH ROW
BEGIN

-- update jumlah keluar pada tabel detail masuk, secara otomatis menjalankan event trigger update tabel detail keluar
UPDATE go_detailmasuk SET jumlah_keluar=jumlah_keluar-OLD.jumlah_keluar, stok=stok+OLD.jumlah_keluar WHERE id=OLD.id_barangmasuk;

END;//
delimiter ;