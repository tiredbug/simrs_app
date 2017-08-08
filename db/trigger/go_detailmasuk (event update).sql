
DROP TRIGGER IF EXISTS update_tabel_detail_masuk;

delimiter //

CREATE TRIGGER update_tabel_detail_masuk AFTER UPDATE ON go_detailmasuk
FOR EACH ROW
BEGIN

-- jika berubah dari 0 ke 1 , atau dengan istilah lain dihapus dari list barang masuk melalu sistem , maka :
-- - kurangi jumlah retun pada tabel obat.
-- - kurangi jumlah masuk pada tabel obat.
-- - kurangi jumlah keluar pada tabel obat
IF OLD.delete='0' AND NEW.delete='1' THEN
	UPDATE go_obat SET jumlah_return=jumlah_return-OLD.jumlah_return, jumlah_masuk=jumlah_masuk-OLD.jumlah_masuk, jumlah_keluar=jumlah_keluar-OLD.jumlah_keluar WHERE kode_obat=OLD.kode_obat;

-- jika berubah dari 1 ke 0 , atau dengan istilah restore kembali data yang dihapus;
-- - tambah kembali jumlah return tabel obat
-- - tambah kemabli jumlah masuk tabel obat
-- - tambah kembali jumlah keluar pada tabel obat
ELSEIF OLD.delete='1' AND NEW.delete='0' THEN
	UPDATE go_obat SET jumlah_return=jumlah_return+OLD.jumlah_return, jumlah_masuk=jumlah_masuk+OLD.jumlah_masuk, jumlah_keluar=jumlah_keluar+OLD.jumlah_keluar WHERE kode_obat=OLD.kode_obat;


-- jika hanya terjadi penambahan pada kolom jumlah_keluar:
-- - update tambah jumlah keluar pada tabel obat
ELSEIF OLD.delete=NEW.delete AND OLD.jumlah_keluar<NEW.jumlah_keluar AND OLD.jumlah_return=NEW.jumlah_return THEN
	UPDATE go_obat SET jumlah_keluar=jumlah_keluar+(NEW.jumlah_keluar-OLD.jumlah_keluar) WHERE kode_obat=OLD.kode_obat;


-- jika hanya terjadi pengurangan pada kolom jumlah keluar:
-- update kurang jumlah keluar pada tabel obat
ELSEIF OLD.delete=NEW.delete AND OLD.jumlah_keluar>NEW.jumlah_keluar AND OLD.jumlah_return=NEW.jumlah_return THEN
	UPDATE go_obat SET jumlah_keluar=jumlah_keluar-(OLD.jumlah_keluar-NEW.jumlah_keluar) WHERE kode_obat=OLD.kode_obat;


-- jika hanya terjadi penambahan pada kolom jumlah return:
-- update tambah jumlah return pada tabel obat
ELSEIF OLD.delete=NEW.delete AND OLD.jumlah_keluar=NEW.jumlah_keluar AND OLD.jumlah_return<NEW.jumlah_return THEN
	UPDATE go_obat SET jumlah_return=jumlah_return+(NEW.jumlah_return-OLD.jumlah_return) WHERE kode_obat=OLD.kode_obat;


-- jika hanya terjadi pengurangan pada kolom jumlah return:
-- update kurang jumlah return padat tabel obat;
ELSEIF OLD.delete=NEW.delete AND OLD.jumlah_keluar=NEW.jumlah_keluar AND OLD.jumlah_return>NEW.jumlah_return THEN
	UPDATE go_obat SET jumlah_return=jumlah_return-(OLD.jumlah_return-NEW.jumlah_return) WHERE kode_obat=OLD.kode_obat;
END IF;


END;//
delimiter ;