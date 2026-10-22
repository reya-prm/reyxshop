-- Trigger: trg_product_stock_status
-- Memastikan sebelum produk diperbarui, nilai stock tidak boleh negatif.
DROP TRIGGER IF EXISTS trg_product_stock_status;

CREATE TRIGGER trg_product_stock_status
BEFORE UPDATE ON products
FOR EACH ROW
BEGIN
    IF NEW.stock < 0 THEN
        SET NEW.stock = 0;
    END IF;
END;
