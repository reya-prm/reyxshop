-- Procedure: sp_update_product_stock
-- Melakukan update stok produk dengan delta (positif = penambahan stok, negatif = pengurangan stok).
-- Menjamin stok tidak bernilai negatif.
DROP PROCEDURE IF EXISTS sp_update_product_stock;

CREATE PROCEDURE sp_update_product_stock(
    IN p_product_id BIGINT UNSIGNED,
    IN p_quantity_delta INT
)
BEGIN
    DECLARE v_current_stock INT DEFAULT 0;
    DECLARE v_new_stock INT DEFAULT 0;

    SELECT COALESCE(stock, 0) INTO v_current_stock
    FROM products
    WHERE id = p_product_id
    FOR UPDATE;

    SET v_new_stock = v_current_stock + p_quantity_delta;
    IF v_new_stock < 0 THEN
        SET v_new_stock = 0;
    END IF;

    UPDATE products
    SET stock = v_new_stock,
        updated_at = NOW()
    WHERE id = p_product_id;
END;
