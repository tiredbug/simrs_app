
DROP TRIGGER IF EXISTS update_tabel_detail_keluar;

delimiter //

CREATE TRIGGER update_tabel_detail_keluar AFTER UPDATE ON go_detailkeluar
FOR EACH ROW
BEGIN
-- jika berubah nilai delete dari 0 ke 1
-- update kurang  data jumlah keluar pada tabel_detail masuk
IF OLD.delete='0' AND NEW.delete='1' THEN
UPDATE go_detailmasuk SET jumlah_keluar=jumlah_keluar-OLD.jumlah_keluar WHERE id=OLD.id_barangmasuk;

ELSEIF OLD.delete='1' AND NEW.delete='0' THEN
-- jika berubah nilai delete dari 1 ke 0
-- update tambah kembali jumlah keluar pada tabel detail masuk
UPDATE go_detailmasuk SET jumlah_keluar=jumlah_keluar+OLD.jumlah_keluar WHERE id=OLD.id_barangmasuk;
END IF;

END;//
delimiter ;