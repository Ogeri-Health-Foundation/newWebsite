CREATE TABLE donation_single (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donation_event_id INT NOT NULL,
    donor_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(10) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    message TEXT NULL,
    donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donation_event_id) REFERENCES donation_events(id) ON DELETE CASCADE
);