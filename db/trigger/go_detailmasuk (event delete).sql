
DROP TRIGGER IF EXISTS delete_tabel_detail_masuk;

delimiter //

CREATE TRIGGER delete_tabel_detail_masuk AFTER DELETE ON go_detailmasuk
FOR EACH ROW
BEGIN

-- ubah jumlah masuk pada tabel obat
UPDATE go_obat SET jumlah_masuk=jumlah_masuk-OLD.jumlah_masuk, jumlah_return=jumlah_return-OLD.jumlah_return, jumlah_keluar=jumlah_keluar-OLD.jumlah_keluar WHERE kode_obat=OLD.kode_obat;

END;//
delimiter ;