# Data Warehouse Operations and Quality Control
![DataETL](https://github.com/Catcurity123/INF20010/blob/main/Picture/DataWarehouse/DataETL.png?raw=true)

### ETL - Extraction - Transformation - Loading

**Extract**: Extracting the data from the source systems.

* Each source system may have their data stored in different data organization or format.

* Parsing extracted data to check if the data meets an expected pattern or structure.

**Transform**: Series of rules or functions applied to extracted data.

* Syntatic rules: Data may have different names, types.

* Semantic rules: Data has different meaning daily and weekly.

* Data Cleaning: Fixing missing data, misspellings, conflicting data.

**Load**: Loading the data into the data warehouse

* A surrogate key is normally added to each row in the DW to avoid problem where multiple source system may use the same key.

### Quality control example

![Quality control](https://github.com/Catcurity123/INF20010/blob/main/Picture/DataWarehouse/Quality_control.png?raw=true)

Rule: Each box must contain 2 red stripes

* Check 1: If a box has wrong color stripes then fix stripes.

* Check 2: If a box has too many stripes then destroy the box

Rule: Each box must have a solid outline

* Check 3: If a box has a dotted outline then fix outline.

**Record each of the problem in this Error Table**

![Error Table](https://github.com/Catcurity123/INF20010/blob/main/Picture/DataWarehouse/Error_Table.png?raw=true)


### Data Cleansing
Detecting poor data is just the beginning, we need to cleans the data. While cleansing a table, we must record details about poor data.

* Store information about rows that contained **invalid data** or **data that must be transformed.**

* **ROWID, Tablename, Description, and Action** of the poor data must be recorded. This type of data is stored in a table known as **Error_Event table**.

``` Error_Event Table Example

Error_Event_Table

| source_table     | record_id | error_type          | error_description                                    | action_taken              |
|------------------|-----------|---------------------|------------------------------------------------------|---------------------------|
| customer_details | 123456    | data_type_mismatch  | Invalid data type for customer age field             | Data type corrected       |
| customer_details | 789012    | missing_data        | Missing customer phone number                         | Contacted data source     |
| order_history    | 345678    | inconsistent_format | Inconsistent date format in order date field          | Date format corrected     |
| billing_info     | 901234    | invalid_data        | Invalid credit card number format                     | Data corrected            |
| customer_details | 567890    | data_type_mismatch  | Invalid data type for customer income field           | Data type corrected       |
| order_history    | 678901    | missing_data        | Missing order quantity field                          | Data imputed from average  |
```

``` SQL
Error_Event_Table A2ERROR_EVENT
CREATE TABLE A2ERROR_EVENT(
source_rowid     ROWID,
source_table   	VARCHAR2(20),
filterid   		NUMBER,
datetime  	DATE,
action		VARCHAR2(6) CHECK (action IN ('SKIP','MODIFY')));
```

#### Filtering and Populating Error_Event table
A **filter** is simply an **SQL statement** that inserts data about an invalid row into the **Error_Event_Table**.

* Filter 1: if a salesprice has a negative value then reject the row

``` SQL
INSERT INTO ERROR_EVENT (source_rowid, source_table, filter_id, action)
SELECT ROWID,'SALES',1,'SKIP'
FROM   SALES s
WHERE  s.saleprice < 0;

-- This statement will copy the designated value from Table s to the Error_Event_Table --
```

* Filter 2: If saledate is **null**, then replace the saledate with the **current date**

``` SQL
INSERT INTO ERROR_EVENT (source_rowid, source_table, filter_id, action)
SELECT ROWID,'SALES',2,'MODIFY'
FROM   SALES s
WHERE  s.saledate IS NULL;
-- This statement will copy the designated value from Table s to the Error_Event_Table --
```

* Filter 3: Skip **orders** where the customer has been deleted since the order was created

``` SQL
INSERT INTO ERROR_EVENT (source_rowid, source_table, filter_id, action)
SELECT ROWID,'ORDERS',3 ,'SKIP'
FROM   ORDERS o
WHERE  o.customer_id NOT IN (SELECT  c.customer_id FROM     CUSTOMER c)
-- This statement will copy the designated value from table 0 to the Error_Event_Table --
```

![Error_event_table_example](https://github.com/Catcurity123/INF20010/blob/main/Picture/DataWarehouse/Error_Event_table.png?raw=true)

Once the Error_Event_Table is craeted, it can be used by another ETL script.
The Script can then choose to:

* If a source table **rowid** value does not exist in the **Error_Event_Table** then **upload** the source row to the DW.

* If a source table **rowid** does exist in the Error_Event_Table then if the action is Modify, the data will be fixed as it is uploaded to the DW.

* If a source table **rowid*8 vlaue does exist in the Error_Event_Table, then if the action is Skip, nothing will be done. The data in the source row will **never** be uploaded to the DW.

#### To find valid rows we can use the following command:

```SQL
SELECT rowid FROM CUST WHERE rowid NOT IN (SELECT source_rowid FROM ERROR_EVENT)
-- This will return rows that is not in the Error_Event_Table --
```

#### We can then upload the clean data to the data warehouse using the following command:

``` SQL
INSERT INTO DWCUST(dwcustID, custname, source_custid, source_table)
SELECT dwcustSeq.nextval, c.custname, c.custid, 'cust' 
FROM cust c 
WHERE rowid NOT IN (SELECT source_rowid FROM Error_Event_Table);
```

#### Some other examples of how to detect error and handle them
```SQL
INSERT INTO DWCUST(dwcustID, custname, source_custid, source_table)
SELECT dwcustSeq.nextval, 'Unknown', c.custid, 'cust' 
FROM cust c 
WHERE rowid NOT IN (SELECT source_rowid FROM Error_Event_Table WHERE filter_id = 6 AND action = 'MODIFY');
```

#### Data Cleaning

**Checking for outliers**:
**NULLs**
```SQL
SELECT rowid, 'PURCHASES', 1, SYSDATE, 3
FROM PURCHASES
WHERE PURCHASE_PRICE IS NULL;
```

**Out of Range**
```SQL
SELECT rowid, 'PURCHASES', 2, SYSDATE, 3
FROM PURCHASES
WHERE PURCHASE_PRICE NOT BETWEEN 2 AND 200;
```

**Out of Domain**
```SQL
SELECT rowid, 'PURCHASES', 3, SYSDATE, 3
FROM PURCHASES
WHERE TODAY_SPECIAL_OFFER NOT IN ('Y','N');
```

**Validating Keys**
**Unique name in Product**

```SQL
--Display any product names that are duplicated--

SELECT name
FROM PRODUCT
GROUP BY name
HAVING COUNT(*) > 1;

NAME
--------------------
Soda Water

--Display rows with duplicated names--
SELECT rowid, 'PRODUCT' AS PRODUCT, SYSDATE, 3 AS ACTION
FROM PRODUCT
WHERE name IN (SELECT     name
               FROM       PRODUCT
               GROUP BY   name
               HAVING     COUNT(*) > 1);

ROWID      PRODUCT SYSDATE   ACTION
---------- ------- --------- ------
GAAAA8mAAA PRODUCT 03/MAY/06      3
GAAAA8mAAF PRODUCT 03/MAY/06      3

```
