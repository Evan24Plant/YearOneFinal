SHOW TABLES;


/*** Games Table ***/

DESC Games;

INSERT INTO Games (name, description, price, console_name) values (
	'Test Game',
    'This game is being used to test the database.',
    '79.99',
    'Microsoft Surface'
);

INSERT INTO Games (name, description, price, console_name) values (
	'Another Test Game',
    'This game is also being used to test the database.',
    '49.99',
    'PS4'
);

SELECT * FROM Games;


/*** Orders Table ***/

DESC Orders;

INSERT INTO Orders (user_id) values (
	007
);

SELECT * FROM Orders;


/*** Receipt Table ***/

DESC Receipt;

INSERT INTO Receipt (receipt_id, game_id, quantity, name, description, price, console_name) values (
	1,
    1,
    3,
    'Test Game', 
    'This game is being used to test the database.',
    '79.99',
    'Microsoft Surface'
);

INSERT INTO Receipt (receipt_id, game_id, quantity, name, description, price, console_name) values (
	1,
    2,
    1,
    'Another Test Game',
    'This game is also being used to test the database.',
    '49.99',
    'PS4'
);

SELECT * FROM Receipt;


/*** ShoppingCart Table ***/

DESC ShoppingCart;

INSERT INTO ShoppingCart values (
	1,
    4,
    2
);

SELECT * FROM ShoppingCart;


/*** Users Table ***/

DESC Users;

INSERT INTO Users (username, password, address, email, user_role) values (
	'EvanPlant',
    'p4ssw0rd',
    '1234 Camosun Ln.',
    '1234@camosun.ca',
    'Admin'
);

INSERT INTO Users (username, password, address, email, user_role) values (
	'DougGreening',
    'SlightlyStrongerP4ssw0rd',
    '1234 Camosun Ln.',
    '12345@camosun.ca',
    'Customer'
);

SELECT * FROM Users;
    