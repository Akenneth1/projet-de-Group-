
CREATE TABLE booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_number VARCHAR(5) NOT NULL,
    is_available TINYINT(1) DEFAULT 1
);
