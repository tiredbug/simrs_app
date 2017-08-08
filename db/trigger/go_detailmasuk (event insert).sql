
DROP TRIGGER IF EXISTS insert_tabel_detail_masuk;

delimiter //

CREATE TRIGGER insert_tabel_detail_masuk AFTER INSERT ON go_detailmasuk
FOR EACH ROW
BEGIN

-- ubah jumlah masuk pada tabel obat
UPDATE go_obat SET jumlah_masuk=jumlah_masuk+NEW.jumlah_masuk WHERE kode_obat=NEW.kode_obat;


END;//
delimiter ;