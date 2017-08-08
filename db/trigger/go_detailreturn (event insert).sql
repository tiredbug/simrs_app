
DROP TRIGGER IF EXISTS insert_tabel_detail_return;

delimiter //

CREATE TRIGGER insert_tabel_detail_return AFTER INSERT ON go_detailreturn
FOR EACH ROW
BEGIN

-- update jumlah return pada tabel detail masuk, secara otomatis menjalankan event trigger update tabel detail return
UPDATE go_detailmasuk SET jumlah_return=jumlah_return+NEW.jumlah_return, stok=stok-NEW.jumlah_return WHERE id=NEW.id_masuk;


END;//
delimiter ;