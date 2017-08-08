
DROP TRIGGER IF EXISTS delete_tabel_detail_return;

delimiter //

CREATE TRIGGER delete_tabel_detail_return AFTER DELETE ON go_detailreturn
FOR EACH ROW
BEGIN

-- ubah jumlah stok pada tabel detail masuk. dan jumlah return
UPDATE go_detailmasuk SET jumlah_return=jumlah_return-OLD.jumlah_return, stok=stok+OLD.jumlah_return WHERE id=OLD.id_masuk;
END;//
delimiter ;