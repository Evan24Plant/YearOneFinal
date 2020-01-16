SELECT * FROM address_book;

SELECT * FROM consoles;

SELECT * FROM games;

SELECT * FROM game_genres ORDER BY game_id;

SELECT * FROM genres;

SELECT * FROM orders;

SELECT * FROM receipt;

SELECT * FROM shopping_cart;

SELECT * FROM users;

/*** CAUTION
	When editing the database, make sure to START TRANSACTION before making any changes.
    Create regular SAVEPOINTs, and ROLLBACK to them if a mistake is made.
    You must COMMIT before closing the database connection, or the database will remain locked until COMMITted.
***/

START TRANSACTION;

COMMIT;

SAVEPOINT a;

ROLLBACK TO a;

/*
DELETE FROM users WHERE user_id > 38;

DELETE FROM games WHERE game_id > 158;
*/

select * from games order by name;


