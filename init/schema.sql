CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(36),
	email VARCHAR(100),
	salty_password VARCHAR(64)
);

CREATE TABLE words(
	id INT AUTO_INCREMENT PRIMARY KEY,
	word_data BLOB,
	file_type VARCHAR(15),
	word VARCHAR(50)
);

CREATE TABLE runs(
	id INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE run_word(
	run_id INT,
	word_id INT,
	position INT, 
	PRIMARY KEY (run_id, position),
	FOREIGN KEY (run_id) REFERENCES  runs(id),
	FOREIGN KEY (word_id) REFERENCES words(id)
);
