CREATE TABLE volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    
    home_address TEXT NOT NULL,
    role ENUM('Patient Clinic', 'Fundraising', 'Administration', 'Marketing') NULL,
    gender ENUM('Male', 'Female') NULL,
    profession VARCHAR(255) NULL,
    profile_picture VARCHAR(255) NULL,
    status ENUM('Pending', 'Accepted', 'Rejected') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    phone VARCHAR(20) UNIQUE NOT NULL
);

ALTER TABLE volunteers ADD COLUMN phone VARCHAR(20) NOT NULL; 