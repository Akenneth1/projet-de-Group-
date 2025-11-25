
USE groupe_project;

CREATE TABLE booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_number VARCHAR(10) NOT NULL,
    is_available TINYINT(1) DEFAULT 1
);
INSERT INTO booking (room_number, is_available) VALUES
('kenneth 1er', 1),  
('Souwoye', 0),  
('C300', 1),  
('Cadillac', 0),
('Rigoli1',1),
('vegeta ',1),
('ADO',0);


