
\c cmps3420;

 CREATE TABLE customers (
	customerID	     	SERIAL NOT NULL,
 	customerLastName     	VARCHAR(20) NOT NULL,
 	customerFirstName    	VARCHAR(25) NOT NULL,
	customerEmail	     	VARCHAR(52) NOT NULL,
	customerPassword     	VARCHAR(52) NOT NULL, 
	CONSTRAINT pk_customers PRIMARY KEY (customerID)
    ) ;

  CREATE TABLE payment (
	customerID	SERIAL NOT NULL,
 	cardName     	VARCHAR(52) NOT NULL,
 	cardNumber    	VARCHAR(20) NOT NULL,
	expDate      	SMALLINT NOT NULL,
	ccv   		VARCHAR(03) NOT NULL , 
	CONSTRAINT fk_customers FOREIGN KEY (customerID)
				      REFERENCES customers(customerID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE
    ) ;

 CREATE TABLE deliveryEmployee (
	employeeID	     	SERIAL NOT NULL, 
 	employeeLastName     	VARCHAR(20) NOT NULL,
 	employeeFirstName    	VARCHAR(25) NOT NULL,
	employeeEmail	     	VARCHAR(52) NOT NULL,
	employeePassword   	VARCHAR(15) NOT NULL, 
	serviceCharge  		money NOT NULL,
	CONSTRAINT pk_deliveryEmployee PRIMARY KEY (employeeID)
    ) ;

 CREATE TABLE restaurants (
	restaurantID	      	SERIAL NOT NULL, 
 	restaurantName     	VARCHAR(25) NOT NULL,
 	restaurantLocation    	VARCHAR(25) NOT NULL,
	CONSTRAINT pk_restaurant PRIMARY KEY (restaurantID)
    ) ;

  CREATE TABLE menu (
	restaurantID	     	SERIAL NOT NULL, 
 	foodID     		SERIAL NOT NULL,
 	foodName    		VARCHAR(50) NOT NULL,
	foodPrice   		money NOT NULL, 
	CONSTRAINT pk_menu PRIMARY KEY (foodID),
	CONSTRAINT fk_menu_restaurants FOREIGN KEY (restaurantID)
				      REFERENCES restaurants(restaurantID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE
    ) ;

     CREATE TABLE orderInformation (
	orderID	     		SERIAL NOT NULL, 
	employeeID	     	SERIAL NOT NULL, 
	customerID	     	SERIAL NOT NULL,
 	tip     		money NOT NULL,
 	destination     	VARCHAR(52) NOT NULL,
 	CONSTRAINT pk_orderInformation PRIMARY KEY (orderID),
	CONSTRAINT fk_orderInformation_deliveryEmployee FOREIGN KEY (employeeID)
				      REFERENCES deliveryEmployee(employeeID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE,
	CONSTRAINT fk_orderInformation_customers FOREIGN KEY (customerID)
				      REFERENCES customers(customerID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE
) ;

   CREATE TABLE itemCart (
	orderID	     		SERIAL NOT NULL,
	restaurantID	     	SERIAL NOT NULL, 
	foodID	     		SERIAL NOT NULL,  
 	totalPrice     		money NOT NULL,
 	quantity    		INTEGER NOT NULL,
	CONSTRAINT fk_itemCart_restaurants FOREIGN KEY (restaurantID)
				      REFERENCES restaurants(restaurantID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE,
	CONSTRAINT fk_itemCart_orderInformation FOREIGN KEY (orderID)
				      REFERENCES orderInformation(orderID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE,
	CONSTRAINT fk_itemCart_menu FOREIGN KEY (foodID)
				      REFERENCES menu(foodID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE
    ) ;

      CREATE TABLE status (
	orderID	     	SERIAL NOT NULL,  
	status	     	INTEGER NOT NULL,  
	startTime     	timestamp NOT NULL,  
	endTIme		timestamp NOT NULL,
	
	CONSTRAINT fk_status_orderInformation FOREIGN KEY (orderID)
				      REFERENCES orderInformation(orderID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE
    ) ;

      CREATE TABLE isIn (
	orderID	     	SERIAL NOT NULL, 
	status     	INTEGER NOT NULL,
	timeUpDate	timestamp NOT NULL,  
	CONSTRAINT fk_isIn_orderInformation FOREIGN KEY (orderID)
				      REFERENCES orderInformation(orderID)
				      ON DELETE CASCADE
				      ON UPDATE CASCADE
    ) ;
