CREATE TABLE review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    rating INT NOT NULL,
    review_text TEXT NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);
