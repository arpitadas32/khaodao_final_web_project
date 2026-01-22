;1users
-- SQL Queries for 'users' table in 'login_system' database
-- 1. Insert a new user
INSERT INTO users (username, email, password, profile_pic)
VALUES ('arpi', 'arpi@example.com', 'hashed_password_here', 'profile.jpg');

-- 2. Retrieve all users
SELECT * FROM users;

-- 3. Retrieve a specific user by email
SELECT * FROM users WHERE email = 'arpi@example.com';

-- 4. Update username and profile picture for a user
UPDATE users
SET username = 'newname', profile_pic = 'newpic.jpg'
WHERE id = 1;

-- 5. Update password for a user (using email as identifier)
UPDATE users
SET password = 'new_hashed_password'
WHERE email = 'arpi@example.com';

-- 6. Delete a user by ID
DELETE FROM users WHERE id = 1;

-- 7. Verify login credentials (email + password match)
SELECT * FROM users
WHERE email = 'arpi@example.com' AND password = 'hashed_password_here';

-- 8. Retrieve users created today
SELECT * FROM users
WHERE DATE(created_at) = CURDATE();




;2 admin
-- 1. Insert a new admin user
INSERT INTO admin (username, password, security_question, security_answer)
VALUES ('adminuser', 'hashed_password_here', 'What is your nickname name?', 'Tousif');

-- 2. Select all admin users
SELECT * FROM admin;

-- 3. Update password and security answer for a specific admin
UPDATE admin
SET password = 'new_hashed_password', security_answer = 'new_answer'
WHERE username = 'adminuser';

-- 4. Delete an admin user by ID
DELETE FROM admin WHERE id = 1;

-- 5. Login check for admin user
SELECT * FROM admin
WHERE username = 'adminuser' AND password = 'hashed_password_here';



;3 menu_items
-- 1. Insert a new menu item
INSERT INTO menu_items (name, price, category, img)
VALUES ('Burger', 150.00, 'Fast Food', 'burger.jpg');

-- 2. Retrieve all menu items
SELECT * FROM menu_items;

-- 3. Retrieve items by category
SELECT * FROM menu_items WHERE category = 'Fast Food';

-- 4. Update price and image for a specific item
UPDATE menu_items
SET price = 160.00, img = 'burger_new.jpg'
WHERE id = 1;

-- 5. Delete a menu item by ID
DELETE FROM menu_items WHERE id = 1;

-- 6. Search for items with no image
SELECT * FROM menu_items WHERE img IS NULL;

-- 7. Find items priced below 100
SELECT * FROM menu_items WHERE price < 100.00;



;4 orders
-- 1. Insert a new order
INSERT INTO orders (user_id, order_data, total_amount, delivery_charge, status)
VALUES (10, '{"name":"Zafrani Sharbat","price":90,"img":"images/zafrani.jpg"}', 210.00, 50.00, 'Pending');

-- 2. Retrieve all orders (latest first)
SELECT * FROM orders ORDER BY created_at DESC;

-- 3. Retrieve orders for a specific user
SELECT * FROM orders WHERE user_id = 10 ORDER BY created_at DESC;

-- 4. Update status of an order
UPDATE orders
SET status = 'Delivered'
WHERE id = 7;

-- 5. Delete an order by ID
DELETE FROM orders WHERE id = 7;

-- 6. Find orders with zero delivery charge
SELECT * FROM orders WHERE delivery_charge = 0.00;

-- 7. Search orders containing 'Beef Chap'
SELECT * FROM orders
WHERE order_data LIKE '%Beef Chap%';



;5 regi
-- 1. Insert a new user
INSERT INTO regi (username, email, password)
VALUES ('arpi', 'arpi@example.com', 'hashed_password_here');

-- 2. Retrieve all users
SELECT * FROM regi;

-- 3. Retrieve a specific user by email
SELECT * FROM regi WHERE email = 'arpi@example.com';

-- 4. Update username and password for a user
UPDATE regi
SET username = 'newname', password = 'new_hashed_password'
WHERE ID = 1;

-- 5. Delete a user by ID
DELETE FROM regi WHERE ID = 1;

-- 6. Login check (email + password match)
SELECT * FROM regi
WHERE email = 'arpi@example.com' AND password = 'hashed_password_here';


;6 assignedorders
-- 1. Insert a new assigned order
INSERT INTO assignedorders (Orderid, pickup, Date)
VALUES ('ORD123', 'Dhanmondi', '2026-01-22 10:30:00.000000');

-- 2. Retrieve all assigned orders
SELECT * FROM assignedorders;

-- 3. Retrieve orders by pickup location
SELECT * FROM assignedorders WHERE pickup = 'Dhanmondi';

-- 4. Update pickup location and date for a specific order
UPDATE assignedorders
SET pickup = 'Uttara', Date = '2026-01-22 11:00:00.000000'
WHERE ID = 1;

-- 5. Delete an assigned order by ID
DELETE FROM assignedorders WHERE ID = 1;

-- 6. Find orders assigned on a specific date
SELECT * FROM assignedorders
WHERE DATE(Date) = '2026-01-22';



;7 deliveryrequest
-- 1. Insert a new delivery request
INSERT INTO deliveryrequest (Orderid, pickup, delivery)
VALUES ('ORD456', 'Dhanmondi', 'Uttara');

-- 2. Retrieve all delivery requests
SELECT * FROM deliveryrequest;

-- 3. Retrieve requests by pickup location
SELECT * FROM deliveryrequest WHERE pickup = 'Dhanmondi';

-- 4. Update delivery location for a specific request
UPDATE deliveryrequest
SET delivery = 'Banani'
WHERE ID = 1;

-- 5. Delete a delivery request by ID
DELETE FROM deliveryrequest WHERE ID = 1;

-- 6. Search requests for a specific order ID
SELECT * FROM deliveryrequest WHERE Orderid = 'ORD456';


;8 order
-- 1. Insert a new order
INSERT INTO `order` (Orderid, Order, price)
VALUES ('ORD789', 'Beef Chap', 220);

-- 2. Retrieve all orders
SELECT * FROM `order`;

-- 3. Retrieve orders by item name
SELECT * FROM `order` WHERE Order = 'Beef Chap';

-- 4. Update item name and price for a specific order
UPDATE `order`
SET Order = 'Zafrani Sharbat', price = 90
WHERE ID = 1;

-- 5. Delete an order by ID
DELETE FROM `order` WHERE ID = 1;

-- 6. Search orders with price above 200
SELECT * FROM `order` WHERE price > 200;




;9 updateddeliverystatus 
-- 1. Insert a new delivery status update
INSERT INTO updateddeliverystatus (Orderid, pickup, delivery)
VALUES ('ORD999', 'Dhanmondi', 'Uttara');

-- 2. Retrieve all delivery status updates
SELECT * FROM updateddeliverystatus;

-- 3. Retrieve updates by pickup location
SELECT * FROM updateddeliverystatus WHERE pickup = 'Dhanmondi';

-- 4. Update delivery location for a specific order
UPDATE updateddeliverystatus
SET delivery = 'Banani'
WHERE ID = 1;

-- 5. Delete a delivery status update by ID
DELETE FROM updateddeliverystatus WHERE ID = 1;

-- 6. Search updates for a specific order ID
SELECT * FROM updateddeliverystatus WHERE Orderid = 'ORD999';







