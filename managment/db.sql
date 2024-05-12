CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL
);

CREATE TABLE food_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    calories_per_100g INT NOT NULL
);

CREATE TABLE food_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    food_item_id INT NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    log_date DATE NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (food_item_id) REFERENCES food_items(id)
);

ALTER TABLE food_items ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;

-- Insert sample patients
INSERT INTO patients (first_name, last_name) VALUES
('John', 'Doe'),
('Alice', 'Smith');

-- Insert sample food items
INSERT INTO food_items (name, calories_per_100g) VALUES
('Apple', 52),
('Banana', 89),
('Chicken Breast', 165),
('Rice (cooked)', 130);

-- Insert sample food logs
INSERT INTO food_logs (patient_id, food_item_id, quantity, log_date) VALUES
(1, 1, 200, '2024-05-10'), -- John ate 200g of Apple on 2024-05-10
(1, 3, 150, '2024-05-11'), -- John ate 150g of Chicken Breast on 2024-05-11
(2, 2, 100, '2024-05-11'); -- Alice ate 100g of Banana on 2024-05-11
