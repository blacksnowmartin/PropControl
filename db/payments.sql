CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date DATE NOT NULL,
    status VARCHAR(50),
    transaction_id VARCHAR(255),
    payment_method VARCHAR(50),
    payment_timestamp TIMESTAMP,
    FOREIGN KEY (tenant_id) REFERENCES tenants(id)
);
