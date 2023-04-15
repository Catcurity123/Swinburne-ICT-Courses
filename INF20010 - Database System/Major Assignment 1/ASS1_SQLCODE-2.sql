
/*
Student Name: Dang Vi Luan
Student ID: 103802759
*/

----- TASK 1 -----

---- Part 1.1 ----
--- ADD_CUST_TO_DB ---
CREATE OR REPLACE PROCEDURE ADD_CUST_TO_DB (pcustid NUMBER, pcustname VARCHAR2) AS
-- Declare variable --
ID_OUT_OF_RANGE EXCEPTION;

-- EXECUTION --
BEGIN
    IF pcustid < 1 OR pcustid > 499 THEN
      RAISE ID_OUT_OF_RANGE;
    END IF;
    INSERT INTO CUSTOMER(CUSTID, CUSTNAME, SALES_YTD, STATUS) VALUES (pcustid, pcustname, 0, 'OK');
    
-- EXCEPTION --
EXCEPTION
    WHEN DUP_VAL_ON_INDEX THEN
        RAISE_APPLICATION_ERROR(-20013,'Duplicate Customer ID');
    WHEN ID_OUT_OF_RANGE THEN
        RAISE_APPLICATION_ERROR(-20023,'Customer ID out of range');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;


/
--- ADD_CUSTOMER_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE ADD_CUSTOMER_VIASQLDEV (pcustid NUMBER, pcustname VARCHAR2) AS
-- Declare variable --
vString clob := '--------------------------------------------';

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    DBMS_OUTPUT.PUT_LINE('Adding Customer. ID: ' || pcustid || ' ' || 'Name: ' || pcustname);
    ADD_CUST_TO_DB(pcustid, pcustname);
    IF (SQL%ROWCOUNT != 0) THEN
        DBMS_OUTPUT.PUT_LINE('Customer Added OK');
    END IF;

-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;



/
---- Part 1.2 ----
--- DELETE_ALL_CUSTOMER_FROM_DB ---
CREATE OR REPLACE FUNCTION DELETE_ALL_CUSTOMERS_FROM_DB RETURN NUMBER AS
-- Declare Variable --
vRowDeleted NUMBER := 0;

-- EXECUTION --
BEGIN
    DELETE  FROM CUSTOMER;
    vRowDeleted := SQL%ROWCOUNT;
    RETURN vRowDeleted;

-- EXCEPTION --
EXCEPTION   
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;



/
--- DELETE_ALL_CUSTOMER_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE DELETE_ALL_CUSTOMERS_VIASQLDEV AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Deleting all Customer rows' ;
vRowDeleted NUMBER := 0;

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    vRowDeleted := DELETE_ALL_CUSTOMERS_FROM_DB();
    DBMS_OUTPUT.PUT_LINE(vRowDeleted || ' rows deleted');
    COMMIT;

-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;
    

/
---- Part 1.3 ----
--- ADD_PRODUCT_TO_DB ---
CREATE OR REPLACE PROCEDURE ADD_PRODUCT_TO_DB (pprodid NUMBER, pprodname VARCHAR2, pprice NUMBER) AS
-- Declare Variable --
ID_OUT_OF_RANGE EXCEPTION;
PRICE_OUT_OF_RANGE EXCEPTION;

-- EXECUTION --
BEGIN
    IF pprodid < 1000 OR pprodid > 2500 THEN
        RAISE ID_OUT_OF_RANGE;
    END IF;
    
    IF pprice < 0 OR pprice > 999.99 THEN
        RAISE PRICE_OUT_OF_RANGE;
    END IF;

    INSERT INTO PRODUCT (PRODID, PRODNAME, SELLING_PRICE, SALES_YTD) VALUES (pprodid, pprodname, pprice, 0);

-- EXCEPTION -- 
EXCEPTION
    WHEN DUP_VAL_ON_INDEX THEN  
        RAISE_APPLICATION_ERROR(-20033, 'Duplicate product ID');
    WHEN ID_OUT_OF_RANGE THEN
        RAISE_APPLICATION_ERROR(-20047, 'Product ID out of range');
    WHEN PRICE_OUT_OF_RANGE THEN
        RAISE_APPLICATION_ERROR(-20051, 'Price out of range');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- ADD_PRODUCT_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE ADD_PRODUCT_VIASQLDEV(pprodid NUMBER, pprodname VARCHAR2, pprice NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------';
vProNum NUMBER := 0;

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    DBMS_OUTPUT.PUT_LINE('Adding Product. ID: ' || pprodid || ' Name: ' || pprodname || ' Price: ' || pprice);
    ADD_PRODUCT_TO_DB(pprodid, pprodname, pprice);
    IF SQL%ROWCOUNT != 0 THEN 
        DBMS_OUTPUT.PUT_LINE('Product Added OK');
    END IF;
    COMMIT;

-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQlERRM);
END;


/
--- DELETE_ALL_PRODUCTS_FROM_DB ---
CREATE OR REPLACE FUNCTION DELETE_ALL_PRODUCTS_FROM_DB RETURN NUMBER AS
-- Declare variable --
vRowDeleted NUMBER;

-- EXECUTION --
BEGIN
    DELETE FROM PRODUCT;
    vRowDeleted := SQL%ROWCOUNT;
    RETURN vRowDeleted;

-- EXCEPTION -- 
EXCEPTION
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- DELETE_ALL_PRODUCTS_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE DELETE_ALL_PRODUCTS_VIASQLDEV AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Deleting all Product rows' ;
vRowDeleted NUMBER := 0;

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    vRowDeleted := DELETE_ALL_PRODUCTS_FROM_DB;
    DBMS_OUTPUT.PUT_LINE(vRowDeleted || ' rows deleted');
    COMMIT;

-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;



/
---- Part 1.4 ----
--- GET_CUST_STRING_FROM_DB ---
CREATE OR REPLACE FUNCTION GET_CUST_STRING_FROM_DB(pcustid NUMBER) RETURN VARCHAR2 AS
-- Declare variable -- 
vCustName CUSTOMER.CUSTNAME%TYPE;
vCustStatus CUSTOMER.STATUS%TYPE;
vCustSales NUMBER;
vStringReturn clob;

-- EXECUTION --
BEGIN
    SELECT CUSTNAME, STATUS, SALES_YTD 
    INTO vCustName, vCustStatus, vCustSales 
    FROM CUSTOMER 
    WHERE CUSTID = pcustid;
    
    vStringReturn:= 'Custid: '||pcustid||' Name: '||vCustName||' Status: '||vCustStatus||' SalesYTD: '||vCustSales;
    RETURN vStringReturn;

-- EXCEPTION --
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RAISE_APPLICATION_ERROR(-20063, 'Customer ID not found');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- GET_CUST_STRING_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE GET_CUST_STRING_VIASQLDEV(pcustid NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Getting Details for CustId ' || pcustid;
vCustDetails clob := '';

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    vCustDetails := GET_CUST_STRING_FROM_DB(pcustid);
    DBMS_OUTPUT.PUT_LINE(vCustDetails);
    
-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


/
--- UPD_CUST_SALESYTD_IN_DB ---
CREATE OR REPLACE PROCEDURE UPD_CUST_SALESYTD_IN_DB(pcustid NUMBER, pamt NUMBER) AS
-- Declare variable --
PAMT_OUT_OF_RANGE EXCEPTION;
CUST_ID_NOT_FOUND EXCEPTION;

-- EXECUTION --
BEGIN
    IF pamt < -999.99 OR pamt > 999.99 THEN
        RAISE PAMT_OUT_OF_RANGE;
    END IF; 

    UPDATE CUSTOMER
    SET SALES_YTD = SALES_YTD + pamt
    WHERE CUSTID = pcustid;

    IF(SQL%NOTFOUND) THEN
        RAISE CUST_ID_NOT_FOUND;
    END IF;

-- EXCEPTION --
EXCEPTION
    WHEN CUST_ID_NOT_FOUND THEN
        RAISE_APPLICATION_ERROR(-20073, 'Customer ID not found');
    WHEN PAMT_OUT_OF_RANGE THEN
        RAISE_APPLICATION_ERROR(-20087, 'Amount out of range');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- UPD__CUST_SALESYTD_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE UPD_CUST_SALESYTD_VIASQLDEV(pcustid NUMBER, pamt NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Updating SalesYTD Customer id: ' || pcustid || ' Amount:' || pamt;

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    UPD_CUST_SALESYTD_IN_DB(pcustid, pamt);
    
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Update Ok');
    END IF;
    COMMIT;

-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;



/
---- Part 1.5 ----
--- GET_PROD_STRING_FROM_DB ---
CREATE OR REPLACE FUNCTION GET_PROD_STRING_FROM_DB(pprodid NUMBER) RETURN VARCHAR2 AS
-- Declare variable -- 
vProdName PRODUCT.PRODNAME%TYPE;
vProdPrice PRODUCT.SELLING_PRICE%TYPE;
vProdSale PRODUCT.SALES_YTD%TYPE;
vStringReturn clob;

-- EXECUTION --
BEGIN
    SELECT PRODNAME, SELLING_PRICE, SALES_YTD 
    INTO vProdName, vProdPrice, vProdSale 
    FROM PRODUCT 
    WHERE PRODID = pprodid;
    
    vStringReturn:= 'ProdId: '||pprodid||' Name: '||vProdName||' Price: '||vProdPrice||' SalesYTD: '||vProdSale;
    RETURN vStringReturn;

-- EXCEPTION --
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RAISE_APPLICATION_ERROR(-20093, 'Product ID not found');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- GET_PROD_STRING_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE GET_PROD_STRING_VIASQLDEV(pprodid NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Getting Details for Prod Id ' || pprodid;
vProdDetails clob := '';

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    vProdDetails := GET_PROD_STRING_FROM_DB(pprodid);
    DBMS_OUTPUT.PUT_LINE(vProdDetails);
    
-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


/
--- UPD_PROD_SALESYTD_IN_DB ---
CREATE OR REPLACE PROCEDURE UPD_PROD_SALESYTD_IN_DB(pprodid NUMBER, pamt NUMBER) AS
-- Declare variable --
PAMT_OUT_OF_RANGE EXCEPTION;
PROD_ID_NOT_FOUND EXCEPTION;

-- EXECUTION --
BEGIN
    IF pamt < -999.99 OR pamt > 999.99 THEN
        RAISE PAMT_OUT_OF_RANGE;
    END IF; 

    UPDATE PRODUCT
     SET SALES_YTD = SALES_YTD + pamt
    WHERE PRODID = pprodid;

    IF(SQL%NOTFOUND) THEN
        RAISE PROD_ID_NOT_FOUND;
    END IF;

-- EXCEPTION --
EXCEPTION
    WHEN PROD_ID_NOT_FOUND THEN
        RAISE_APPLICATION_ERROR(-20103, 'Product ID not found');
    WHEN PAMT_OUT_OF_RANGE THEN
        RAISE_APPLICATION_ERROR(-20117, 'Amount out of range');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- UPD__PROD_SALESYTD_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE UPD_PROD_SALESYTD_VIASQLDEV(pprodid NUMBER, pamt NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Updating SalesYTD Product id: ' || pprodid || ' Amount:' || pamt;

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    UPD_PROD_SALESYTD_IN_DB(pprodid, pamt);
    
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Update Ok');
    END IF;
    COMMIT;

-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;




/
---- PART 1.6 ----
--- UPD_CUST_STATUS_IN_DB ---
CREATE OR REPLACE PROCEDURE UPD_CUST_STATUS_IN_DB(pcustid NUMBER, pstatus VARCHAR2) AS
-- Declare variable --
INVALID_STATUS EXCEPTION;
CUST_ID_NOT_FOUND EXCEPTION;

-- EXECUTION --
BEGIN
    IF pstatus = 'OK' OR pstatus = 'SUSPEND' THEN
        UPDATE CUSTOMER
        SET STATUS = pstatus
        WHERE CUSTID = pcustid;
    ELSE
        RAISE INVALID_STATUS;
    END IF;
    
    IF SQL%NOTFOUND THEN
        RAISE CUST_ID_NOT_FOUND;
    END IF;

-- EXCEPTION --
EXCEPTION
    WHEN CUST_ID_NOT_FOUND THEN
        RAISE_APPLICATION_ERROR(-20123, 'Customer ID not found');
    WHEN INVALID_STATUS THEN
        RAISE_APPLICATION_ERROR(-20137, 'Invalid Status value');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- UPD__CUST_STATUS_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE UPD_CUST_STATUS_VIASQLDEV(pcustid NUMBER, pstatus VARCHAR2) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Updating Status. Id: ' || pcustid || ' New Status:' || pstatus;

-- EXECUTION --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    UPD_CUST_STATUS_IN_DB(pcustid, pstatus);
    
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Update Ok');
    END IF;
    COMMIT;

-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


/
---- PART 1.7 ----
--- ADD_SIMPLE_SALE_TO_DB ---
CREATE OR REPLACE PROCEDURE ADD_SIMPLE_SALE_TO_DB (pcustid NUMBER, pprodid NUMBER, pqty NUMBER) AS
-- DECALRE EXCEPTION --
SALE_QUANTITY_OUT_OF_RANGE EXCEPTION;
INVALID_CUSTID EXCEPTION;
CUST_STATUS_NOT_OK EXCEPTION;
INVALID_PRODID EXCEPTION;

-- DECALRE VARIABLE --
vCustStatus CUSTOMER.STATUS%TYPE;
vProdPrice PRODUCT.SELLING_PRICE%TYPE;
vUpdatedValue NUMBER := 0;

-- EXECUTION --
BEGIN   
    -- Check Quantity valid --
    IF pqty < 0 OR pqty > 999 THEN
        RAISE SALE_QUANTITY_OUT_OF_RANGE;
    END IF;

    -- Check productId valid and assign new value --
    SELECT SELLING_PRICE INTO vProdPrice FROM PRODUCT
    WHERE PRODID = pprodid;

    -- Check CustID valid and CustStatus OK --
    SELECT STATUS INTO vCustStatus FROM CUSTOMER
    WHERE CUSTID = pcustid;
    IF vCustStatus != 'OK' THEN
        RAISE CUST_STATUS_NOT_OK;
    END IF;
    
    IF SQL%NOTFOUND THEN
        IF vCustStatus IS NULL THEN
            RAISE INVALID_CUSTID;
        END IF;
        
        IF vProdPrice IS NULL THEN
            RAISE INVALID_PRODID ;
        END IF;
    END IF;
    
    vUpdatedValue := pqty * vProdPrice;
    -- Update data in DB--
    UPD_CUST_SALESYTD_IN_DB(pcustid, vUpdatedValue);
    UPD_PROD_SALESYTD_IN_DB(pprodid, vUpdatedValue);

    
-- EXCEPTION --
EXCEPTION
    WHEN SALE_QUANTITY_OUT_OF_RANGE THEN
        RAISE_APPLICATION_ERROR(-20143, 'Sale Quantity outside valid range');
    WHEN CUST_STATUS_NOT_OK THEN
        RAISE_APPLICATION_ERROR(-20157, 'Customer Status is not OK');
    WHEN INVALID_CUSTID THEN
        RAISE_APPLICATION_ERROR(-20161, 'Customer ID not found');
    WHEN INVALID_PRODID THEN
        RAISE_APPLICATION_ERROR(-20175, 'Product ID not found');
    WHEN OTHERS THEN    
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;
    
    
/
--- ADD_SIMPLE_SALE_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE ADD_SIMPLE_SALE_VIASQLDEV (pcustid NUMBER, pprodid NUMBER, pqty NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Adding Simple Sale. Cust Id: ' || pcustid || ' Prod ID: ' || pprodid || ' Qty: ' || pqty;

-- Execution --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    ADD_SIMPLE_SALE_TO_DB(pcustid, pprodid, pqty);
    IF SQL%ROWCOUNT > 0 THEN   
        DBMS_OUTPUT.PUT_LINE('Added Simple Sale OK');
    END IF;
    COMMIT;

-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;



/
---- PART 1.8 ----
--- SUM_CUST_SALESYTD ---
CREATE OR REPLACE FUNCTION SUM_CUST_SALESYTD RETURN NUMBER AS
-- Declare variable--
vSum NUMBER;

-- Execution --
BEGIN
    SELECT SUM(SALES_YTD)INTO vSum FROM CUSTOMER;
    RETURN vSum;

-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- SUM_CUST_SALES_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE SUM_CUST_SALES_VIASQLD AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Summing Customer SalesYTD';
vSum NUMBER := 0;

-- Execution --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    vSum := SUM_CUST_SALESYTD();
    
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('All Customer Total: ' || vSum);
    ELSE
        DBMS_OUTPUT.PUT_LINE('All Customer Total: 0');
    END IF;

-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;



/
--- SUM_PROD_SALESYTD_FROM_DB ---
CREATE OR REPLACE FUNCTION SUM_PROD_SALESYTD_FROM_DB  RETURN NUMBER AS
-- Declare variable--
vSum NUMBER;

-- Execution --
BEGIN
    SELECT SUM(SALES_YTD)INTO vSum FROM PRODUCT;
    RETURN vSum;

-- EXCEPTION --
EXCEPTION 
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;


/
--- SUM_CUST_SALES_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE SUM_PROD_SALES_VIASQLD AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Summing Product SalesYTD';
vSum NUMBER := 0;

-- Execution --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    vSum := SUM_PROD_SALESYTD_FROM_DB ();
    
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('All Product Total: ' || vSum);
    ELSE
        DBMS_OUTPUT.PUT_LINE('All Product Total: 0');
    END IF;

-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


















/

----- TASK 2 -----

---- Part 2.1 ----
--- GET_ALLCUST ---
CREATE OR REPLACE FUNCTION GET_ALLCUST RETURN SYS_REFCURSOR AS
-- Declare variable --
CustCursor SYS_REFCURSOR;

-- Execution --
BEGIN
    OPEN CustCursor FOR SELECT * FROM CUSTOMER;
    RETURN CustCursor;
    CLOSE CustCursor;
    
-- Exception --
EXCEPTION
    WHEN OTHERS THEN 
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;
/



--- GET_ALLCUST_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE GET_ALLCUST_VIASQLDEV AS
-- Declare variable --
CustCursor SYS_REFCURSOR;
CustDetails CUSTOMER%ROWTYPE;
vString clob := '--------------------------------------------' || CHR(10) || 'Listing All Customer Details';

-- Execution --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    CustCursor := GET_ALLCUST;
    
    LOOP
        FETCH CustCursor INTO CustDetails;
        EXIT WHEN CustCursor%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE('CustID: ' || CustDetails.CUSTID || ' Name: ' || CustDetails.CUSTNAME || ' Status: ' || CustDetails.STATUS || ' SalesYTD: ' || CustDetails.SALES_YTD);
    END LOOP;
    
    IF SQL%NOTFOUND THEN
        DBMS_OUTPUT.PUT_LINE('No rows found');
    END IF;

-- Exception --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;
    


/
--- GET_ALLPROD_FROM_DB ---
CREATE OR REPLACE FUNCTION GET_ALLPROD_FROM_DB RETURN SYS_REFCURSOR AS
-- Declare variable -- 
ProdCursor SYS_REFCURSOR;

-- Execution --
BEGIN
    OPEN ProdCursor FOR SELECT * FROM PRODUCT;
    RETURN ProdCursor;
    CLOSE ProdCursor;

-- Exception --
EXCEPTION
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-2000,SQLERRM);
END;


/
--- GET_ALLPROD_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE GET_ALLPROD_VIASQLDEV AS
-- Declare variable --
ProdCursor SYS_REFCURSOR;
ProdDetails PRODUCT%ROWTYPE;
vString clob := '--------------------------------------------' || CHR(10) || 'Listing All Product Details';

-- EXECUTION --
BEGIN
     DBMS_OUTPUT.PUT_LINE(vString);
     ProdCursor := GET_ALLPROD_FROM_DB;
     
     LOOP
        FETCH ProdCursor INTO ProdDetails;
        EXIT WHEN ProdCursor%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE('ProdId: ' || ProdDetails.PRODID || ' Name: ' || ProdDetails.PRODNAME || ' Price: ' || ProdDetails.SELLING_PRICE || ' SalesYTD: ' || ProdDetails.SALES_YTD);
    END LOOP;

    IF SQL%NOTFOUND THEN
        DBMS_OUTPUT.PUT_LINE('No rows found');
    END IF;

-- Exception --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;
    


















/

----- TASK 3 -----

---- Part 3.1 ----
--- ADD_LOCATION_TO_DB ---
CREATE OR REPLACE PROCEDURE ADD_LOCATION_TO_DB (ploccode VARCHAR2, pminqty NUMBER, pmaxqty NUMBER) AS
INVALID_LOCID_LENGTH EXCEPTION;
CHECK_MINQTY_RANGE EXCEPTION;
CHECK_MAXQTY_RANGE EXCEPTION;
CHECK_MAXQTY_GREATER_MIXQTY EXCEPTION;



-- EXECUTION --
BEGIN   
    IF LENGTH(ploccode) != 5 THEN
        RAISE INVALID_LOCID_LENGTH;
    END IF;
    
    IF pminqty < 0 OR pminqty > 999 THEN
        RAISE CHECK_MINQTY_RANGE;
    END IF;
    
    IF pmaxqty < 0 OR pmaxqty > 999 THEN
        RAISE CHECK_MAXQTY_RANGE;
    END IF;
    
    IF pmaxqty < pminqty THEN
        RAISE CHECK_MAXQTY_GREATER_MIXQTY;
    END IF;
    
    
    
    INSERT INTO LOCATION VALUES(ploccode, pminqty, pmaxqty);

-- Exception --
EXCEPTION
    WHEN DUP_VAL_ON_INDEX THEN
        RAISE_APPLICATION_ERROR(-20183, 'Duplicate location ID');
        
    WHEN INVALID_LOCID_LENGTH THEN
        RAISE_APPLICATION_ERROR(-20197, 'Location Code length invalid');
        
    WHEN     CHECK_MINQTY_RANGE THEN
        RAISE_APPLICATION_ERROR(-20201,'Minimum Qty out of range');
        
    WHEN     CHECK_MAXQTY_RANGE THEN
        RAISE_APPLICATION_ERROR(-20215,'Maximum Qty out of range');
        
    WHEN     CHECK_MAXQTY_GREATER_MIXQTY THEN
        RAISE_APPLICATION_ERROR(-20222,'Minimum Qty larger than Maximum Qty');
        
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000, SQLERRM);
END;



/
--- ADD_LOCATION_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE ADD_LOCATION_VIASQLDEV (ploccode VARCHAR2, pminqty NUMBER, pmaxqty NUMBER) AS
-- Declare variable --
vString clob := '--------------------------------------------' || CHR(10) || 'Adding Location. LocCode: ' || ploccode || ' MinQty: ' || pminqty || ' MaxQty: ' || pmaxqty;

--EXECUTION--
BEGIN 
    DBMS_OUTPUT.PUT_LINE(vString);
    ADD_LOCATION_TO_DB(ploccode,pminqty,pmaxqty);
    IF SQL%ROWCOUNT != 0 THEN
        DBMS_OUTPUT.PUT_LINE('Location Added OK');
    END IF;
    
-- Exception --
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;



















----- TASK 4 -----

---- Part 4.1 ----

/
--- ADD_COMPLEX_SALE_TO_DB ---
CREATE OR REPLACE PROCEDURE ADD_COMPLEX_SALE_TO_DB (pcustid NUMBER, pprodid NUMBER, pqty NUMBER, pdate Varchar2) AS
-- Declare variable --
vCustStatus CUSTOMER.STATUS%TYPE;
vDate DATE;
vProdPrice NUMBER;
vUpdatedValue NUMBER := 0;
-- Decalre Exception --
INVALID_CUST_STATUS EXCEPTION;
INVALID_QTY EXCEPTION;
INVALID_DATE EXCEPTION;
INVALID_CUST_ID EXCEPTION;
INVALID_PROD_ID EXCEPTION;

-- EXECUTION --
BEGIN
    SELECT STATUS INTO vCustStatus FROM CUSTOMER 
    WHERE CUSTID = pcustid;
    IF vCustStatus != 'OK' THEN
        RAISE INVALID_CUST_STATUS;
    END IF;
    
    IF LENGTH(pdate) != 8 THEN
        RAISE INVALID_DATE;
    END IF;
    
    IF pqty < 1 OR pqty > 999 THEN
        RAISE INVALID_QTY;
    END IF;
    
    vDate := TO_DATE(pdate, 'YYYYMMDD');
    IF vDate IS NULL THEN
        RAISE INVALID_DATE;
    END IF;
    
    SELECT SELLING_PRICE INTO vProdPrice FROM PRODUCT
    WHERE PRODID = pprodid;
    
    INSERT INTO SALE(SALEID, CUSTID, PRODID, QTY, PRICE, SALEDATE) VALUES(SALE_SEQ.nextval, pcustid, pprodid, pqty, vProdPrice, vDate);
    
    vUpdatedValue := pqty * vProdPrice;
    
    UPD_CUST_SALESYTD_IN_DB(pcustid, vUpdatedValue);
    UPD_PROD_SALESYTD_IN_DB(pprodid,vUpdatedValue);

-- EXCEPTION --
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        IF vCustStatus IS NULL THEN
            RAISE_APPLICATION_ERROR(-20265, 'Customer ID not found');
        END IF;
        
        IF vProdPrice IS NULL THEN
            RAISE_APPLICATION_ERROR(-20272, 'Product ID not found');
        END IF;
        
    WHEN  INVALID_CUST_STATUS THEN
        RAISE_APPLICATION_ERROR(-20247, 'Customer status is not OK');
    
    WHEN INVALID_DATE THEN
        RAISE_APPLICATION_ERROR(-20251, 'Date not valid');
    
    WHEN INVALID_QTY THEN
        RAISE_APPLICATION_ERROR(-20233, 'Sale Quantity outside valid range');
    
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;
        
/

--- ADD_COMPLEX_SALE_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE ADD_COMPLEX_SALE_VIASQLDEV (pcustid NUMBER, pprodid NUMBER, pqty NUMBER, pdate VARCHAR2) AS
-- Declare variable --
vUpdatedValue NUMBER := 0;
vProdPrice NUMBER;
vString clob := '--------------------------------------------' || CHR(10) || 'Adding Complex Sale. Cust ID ' || pcustid || ' Prod ID: ' || pprodid || ' Date: ' || pdate || ' Amount: ' ;

-- EXECUTION --
BEGIN
    SELECT SELLING_PRICE INTO vProdPrice FROM PRODUCT 
    WHERE PRODID = pprodid;
    vUpdatedValue := pqty * vProdPrice;
    IF vUpdatedValue IS NULL THEN
        vUpdatedValue := 0;
    END IF;
    DBMS_OUTPUT.PUT_LINE(vString || vUpdatedValue);
    
    ADD_COMPLEX_SALE_TO_DB(pcustid, pprodid, pqty, pdate);
    
    IF(SQL%ROWCOUNT > 0) THEN
        DBMS_OUTPUT.PUT_LINE('Added Complex Sale OK');
    END IF;
    
-- EXCEPTION --
EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


/

--- GET_ALLSALES_FROM_DB ---
CREATE OR REPLACE FUNCTION GET_ALLSALES_FROM_DB RETURN SYS_REFCURSOR AS
-- Declare variable --
SaleCursor SYS_REFCURSOR;
-- EXECUTION --
BEGIN   
    OPEN SaleCursor FOR SELECT * FROM SALE;
    RETURN SaleCursor;
-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN 
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;

/
--- GET_ALLSALES_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE  GET_ALLSALES_VIASQLDEV AS
-- Declare variable -- 
SaleDetails SYS_REFCURSOR;
SaleRecord SALE%ROWTYPE;
vString clob := '--------------------------------------------' || CHR(10) || 'Listing All Complex Sales Details ';
-- Execution --
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    SaleDetails :=  GET_ALLSALES_FROM_DB;
    LOOP
        FETCH SaleDetails INTO SaleRecord;
        EXIT WHEN SaleDetails%NOTFOUND;
       DBMS_OUTPUT.PUT_LINE('SaleID: '||SaleRecord.SALEID||' CustID: '||SaleRecord.CUSTID||' ProdID: '||SaleRecord.PRODID||' Date: '||SaleRecord.SALEDATE||' Amount: '||SaleRecord.QTY*SaleRecord.PRICE);
    END LOOP;
    
    IF SQL%NOTFOUND THEN
        DBMS_OUTPUT.PUT_LINE('No rows found');
    END IF;
    
-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
         DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;

/
--- COUNT_PRODUCT_SALES_FROM_DB ---
CREATE OR REPLACE FUNCTION COUNT_PRODUCT_SALES_FROM_DB (pdays NUMBER) RETURN NUMBER AS 
-- Declare variable --
vSale NUMBER;
-- EXECUTION --
BEGIN 
    SELECT COUNT(SALEDATE) INTO vSale FROM SALE WHERE ((SYSDATE - SALEDATE) < pdays);
    RETURN vSale;
-- EXCEPTION --
EXCEPTION
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;


/
--- COUNT_PRODUCT_SALES_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE COUNT_PRODUCT_SALES_VIASQLDEV(pdays NUMBER) AS
-- Declare variable --
vSale NUMBER;
vString clob := '--------------------------------------------' || CHR(10) || 'Counting sales within  ';
vDays NUMBER := ROUND(pdays,0);

--Execution--
BEGIN
    DBMS_OUTPUT.PUT_LINE(vString || vDays || ' days');
    vSale := COUNT_PRODUCT_SALES_FROM_DB(pdays);
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Total number of sales: ' || vSale);
    END IF;

-- EXCEPTION --
Exception
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


/
--- DELETE_SALE_FROM_DB ---
CREATE OR REPLACE FUNCTION DELETE_SALE_FROM_DB RETURN NUMBER AS
-- Declare Variable --
vMinSaleId SALE.SALEID%TYPE;
vQty SALE.QTY%TYPE;
vProdPrice SALE.PRICE%TYPE;
vCustId SALE.CUSTID%TYPE;
vProdId SALE.PRODID%TYPE;
vUpdatedValue NUMBER;

NO_SALE_ROW_FOUND EXCEPTION;

-- EXECUTION --
BEGIN
    SELECT MIN(SALEID) INTO vMinSaleId FROM SALE;
    IF vMinSaleId IS NULL THEN
        RAISE NO_SALE_ROW_FOUND;
    END IF;
    
    SELECT CUSTID, PRODID, QTY, PRICE INTO vCustId, vProdId, vQty, vProdPrice FROM SALE
    WHERE SALEID = vMinSaleId;
    DELETE FROM SALE WHERE SALEID = vMinSaleId;
    
    vUpdatedValue := vQty * vProdPrice;
    
    UPD_CUST_SALESYTD_IN_DB(vCustId, -vUpdatedValue);
    UPD_PROD_SALESYTD_IN_DB(vProdId, -vUpdatedValue);
    
    RETURN vMinSaleId;

-- EXCEPTION --
EXCEPTION
    WHEN NO_SALE_ROW_FOUND THEN
        RAISE_APPLICATION_ERROR(-20283, 'No Sale Rows Found');
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;



/
--- DELETE_SALE_VIASQLDEV --
CREATE OR REPLACE PROCEDURE DELETE_SALE_VIASQLDEV AS
DeletedId NUMBER;
vString clob := '--------------------------------------------' || CHR(10) || 'Deleting Sale with smallest SaleID value  ';

BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    DeletedId := DELETE_SALE_FROM_DB;
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Deleted Sale OK. SaleID: ' || DeletedId);
        COMMIT;
    END IF;
    
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;


/
--- DELETE_ALLL_SALES_FROM_DB ---
CREATE OR REPLACE PROCEDURE DELETE_ALL_SALES_FROM_DB AS
-- Declare variable--
CustCursor SYS_REFCURSOR;
CustDetails CUSTOMER%ROWTYPE;

ProdCursor SYS_REFCURSOR;
ProdDetails PRODUCT%ROWTYPE;

BEGIN
    DELETE FROM SALE;
    
    OPEN CustCursor FOR SELECT * FROM CUSTOMER;
    LOOP
        FETCH CustCursor INTO CustDetails;
        EXIT WHEN CustCursor%NOTFOUND;
        UPD_CUST_SALESYTD_IN_DB(CustDetails.CUSTID, (-CustDetails.SALES_YTD));
    END LOOP;
    CLOSE CustCursor;
    
    
    
    OPEN ProdCursor FOR SELECT * FROM PRODUCT;
    LOOP
        FETCH ProdCursor INTO ProdDetails;
        EXIT WHEN ProdCursor%NOTFOUND;
        UPD_PROD_SALESYTD_IN_DB(ProdDetails.PRODID, (-ProdDetails.SALES_YTD));
    END LOOP;
    CLOSE ProdCursor;
    
EXCEPTION
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;
    
    
/

--- DELETE_ALL_SALES_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE DELETE_ALL_SALES_VIASQLDEV AS
vString clob := '--------------------------------------------' || CHR(10) || 'Deleting all Sales data in Sale, Customer, and Product Tables  ';

BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    DELETE_ALL_SALES_FROM_DB;
    IF SQL%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Deletion OK');
    END IF;

EXCEPTION
    WHEN OTHERS THEN 
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;
/







----- TASK 5 -----

---- Part 5.1 ----
--- Delete _Customer ---
CREATE OR REPLACE PROCEDURE DELETE_CUSTOMER (pCustid NUMBER) AS
CUSTOMER_CHILD_FOUND EXCEPTION;
CUSTOMER_ID_NOT_FOUND EXCEPTION;

PRAGMA EXCEPTION_INIT(CUSTOMER_CHILD_FOUND, -2292);
BEGIN
    DELETE FROM CUSTOMER WHERE CUSTID = pCustid;
    IF SQL%NOTFOUND THEN
        RAISE CUSTOMER_ID_NOT_FOUND;
    END IF;
    
EXCEPTION
    WHEN CUSTOMER_ID_NOT_FOUND THEN
        RAISE_APPLICATION_ERROR(-20293, 'Customer ID not found');
    
    WHEN CUSTOMER_CHILD_FOUND THEN
        RAISE_APPLICATION_ERROR(-20307,'Customer cannot be deleted as sales exist');
    
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;

/
--- DELETE_CUSTOMER_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE DELETE_CUSTOMER_VIASQLDEV (pcustid NUMBER) AS 
vString clob := '--------------------------------------------' || CHR(10) || 'Deleting Customer. Cust Id:  ' || pcustid;

BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    DELETE_CUSTOMER(pcustid);
    IF SQL%FOUND THEN 
        DBMS_OUTPUT.PUT_LINE('Deleted Customer OK.');
    END IF;
    COMMIT;
    
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;








/
--- DELETE_PROD_FROM_DB ---

CREATE OR REPLACE PROCEDURE DELETE_PROD_FROM_DB (pprodid NUMBER) AS
PRODUCT_CHILD_FOUND EXCEPTION;
PRODUCT_ID_NOT_FOUND EXCEPTION;

PRAGMA EXCEPTION_INIT(PRODUCT_CHILD_FOUND, -2292);
BEGIN
    DELETE FROM PRODUCT WHERE PRODID = pprodid;
    IF SQL%NOTFOUND THEN
        RAISE PRODUCT_ID_NOT_FOUND;
    END IF;
    
EXCEPTION
    WHEN PRODUCT_ID_NOT_FOUND THEN
        RAISE_APPLICATION_ERROR(-20313, 'Product ID not found');
    
    WHEN PRODUCT_CHILD_FOUND THEN
        RAISE_APPLICATION_ERROR(-20327,'Product cannot be deleted as sales exist');
    
    WHEN OTHERS THEN
        RAISE_APPLICATION_ERROR(-20000,SQLERRM);
END;


/
--- DELETE_PROD_VIASQLDEV ---
CREATE OR REPLACE PROCEDURE DELETE_PROD_VIASQLDEV (pprodid NUMBER) AS 
vString clob := '--------------------------------------------' || CHR(10) || 'Deleting Product. Product Id:  ' || pprodid;

BEGIN
    DBMS_OUTPUT.PUT_LINE(vString);
    DELETE_PROD_FROM_DB(pprodid);
    IF SQL%FOUND THEN 
        DBMS_OUTPUT.PUT_LINE('Deleted Product OK.');
    END IF;
    COMMIT;
    
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE(SQLERRM);
END;
/


