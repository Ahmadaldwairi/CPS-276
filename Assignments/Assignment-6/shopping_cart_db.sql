-- Create Customer Table
CREATE TABLE Customer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    address VARCHAR(255),
    city VARCHAR(50),
    state VARCHAR(50),
    zip VARCHAR(20),
    phone VARCHAR(20),
    email VARCHAR(100),
    password VARCHAR(255)
) ENGINE=InnoDB;

-- Create Product Group Table
CREATE TABLE ProductGroup (
    id INT PRIMARY KEY AUTO_INCREMENT,
    groupname VARCHAR(100),
    imagefolder VARCHAR(255)
) ENGINE=InnoDB;

-- Create Product Table
CREATE TABLE Product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    groupid INT,
    productname VARCHAR(100),
    productprice DECIMAL(10,2),
    image VARCHAR(255),
    description TEXT,
    FOREIGN KEY (groupid) REFERENCES ProductGroup(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Create Orders Table
CREATE TABLE Orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    customerid INT,
    FOREIGN KEY (customerid) REFERENCES Customer(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Create Order Info Table
CREATE TABLE OrderInfo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    orderid INT,
    productid INT,
    amount INT,
    FOREIGN KEY (orderid) REFERENCES Orders(id) ON DELETE CASCADE,
    FOREIGN KEY (productid) REFERENCES Product(id) ON DELETE CASCADE
) ENGINE=InnoDB;
