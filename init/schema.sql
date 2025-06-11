CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(36),
	email VARCHAR(100),
	salty_password VARCHAR(64)
);

CREATE TABLE word(
	id INT AUTO_INCREMENT PRIMARY KEY,
	word_data BLOB,
	file_type VARCHAR(6),
	word VARCHAR(50)
);

CREATE TABLE run(
	id INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE run_word(
	run_Id INT,
	word_Id INT,
	FOREIGN KEY (run_id) REFRENCES run(id),
	FOREIGN KEY (word_id) REFRENCES word(id)
);
