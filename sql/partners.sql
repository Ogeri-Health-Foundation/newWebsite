CREATE TABLE partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_logo VARCHAR(255) NULL,
    partner_name VARCHAR(255) NOT NULL,
    partner_email VARCHAR(255) NOT NULL UNIQUE,
    partner_phone VARCHAR(20) NULL,
    company_address VARCHAR(255) NULL,
    business_type ENUM('Technology', 'Finance', 'Healthcare', 'Retail', 'Education', 'Other') NOT NULL,
    partnership_type ENUM('Sponsor', 'Collaborator', 'Service Provider', 'Investor') NOT NULL,
    contact_person VARCHAR(255) NULL,
    contact_role VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
