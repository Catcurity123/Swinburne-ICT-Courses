-- TASK 1 --
CREATE TABLE cars(
    car_id INT AUTO_INCREMENT PRIMARY KEY,
     make VARCHAR(50),
    model VARCHAR(50),
     price DECIMAL(10,2),
     yom INT);


INSERT INTO cars (make,model,price,yom)
    VALUES
    ('Holden', 'Astra', 14000, 2005),
    ('BMW', 'X3', 35000, 2004),
    ('Ford', 'Falcon', 39000, 2011),
    ('Toyota', 'Corolla', 20000, 2012),
    ('Holden', 'Commodore', 13500, 2005),
    ('Holden', 'Astra', 8000, 2001),
    ('Holden', 'Commodore', 28000, 2009),
    ('Ford', 'Falcon', 14000, 2007),
    ('Ford', 'Falcon', 7000, 2003),
    ('Ford', 'Laser', 10000, 2010),
    ('Mazda', 'RX-7', 26000, 2000);


-- TASK 2 --

-- 1 --

Select * from cars;

-- 2 --

Select make,model,price from cars ORDER BY make,model;

-- 3 --

SELECT make,model FROM cars WHERE price >= 20000;

-- 4 --

SELECT make,model FROM cars WHERE price < 15000

-- 5 --
5-	SELECT make, AVG(price) FROM cars GROUP BY make;

