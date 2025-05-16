-- Drop tables if they exist
DROP TABLE IF EXISTS users_items CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS items CASCADE;
DROP TABLE IF EXISTS contact CASCADE;

-- Table: contact
CREATE TABLE contact (
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  message VARCHAR(255) NOT NULL
);

-- Table: items
CREATE TABLE items (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INTEGER NOT NULL
);

-- Insert data into items
INSERT INTO items (id, name, price) VALUES
(1, 'Apple iPhone X 64 GB', 70000),
(2, 'Apple iPhone XS 64 GB', 88000),
(3, 'Apple iPhone XR 64 GB', 45000),
(4, 'Apple iPhone 11 64 GB', 51000),
(5, 'Apple iPhone 11 Pro 64 GB', 80000),
(6, 'Apple iPhone 11 Pro Max 64 GB', 110000),
(7, 'Apple iPhone 12&12 Mini 64GB', 70000),
(8, 'Apple iPhone 12 Pro&Pro Max 128 GB', 158000),
(9, 'Apple iPhone SE 2020 64 GB', 36000);

-- Table: users
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  contact VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL
);

-- Table: users_items
CREATE TABLE users_items (
  id SERIAL PRIMARY KEY,
  user_id INTEGER NOT NULL,
  item_id INTEGER NOT NULL,
  status TEXT NOT NULL CHECK (status IN ('Added to cart', 'Confirmed')),
  CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT fk_item FOREIGN KEY(item_id) REFERENCES items(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
