-- Function: fn_product_final_price
-- Menghitung harga dasar produk dari tabel products berdasarkan product_id.
-- Return: DECIMAL(14, 2)
DROP FUNCTION IF EXISTS fn_product_final_price;

CREATE FUNCTION fn_product_final_price(p_product_id BIGINT UNSIGNED)
RETURNS DECIMAL(14, 2)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE v_price DECIMAL(14, 2) DEFAULT 0.00;

    SELECT COALESCE(price, 0.00) INTO v_price
    FROM products
    WHERE id = p_product_id
    LIMIT 1;

    RETURN v_price;
END;
