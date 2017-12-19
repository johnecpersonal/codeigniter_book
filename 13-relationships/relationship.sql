ALTER TABLE purchases
ADD user_id int(9);

ALTER TABLE purchases
ADD FOREIGN KEY (user_id) REFERENCES users(id);

UPDATE purchases
SET user_id = 1;
