
# Data Warehouse



## Description:
It is a system that integrates data, stores data, typically in dimensional/de-normalized form. Data Warehouse is majorly used for Analytics, Reporting & BI. It also maintains history data.


### **What is the need for Data Warehouse?**
**Data Warehouse** is a centralized repository for data that is used to store, manage, and analyze large volumes of data from various sources. The need for data warehouse originates from the following:

* **Data Volume**: Overwhelming data from business's day to day operation required a centralized location to be stored and made easier to manage and analyze.

* **Data Integration**: Data from various sources that came from different format requires a standardized scheme to be integrated and analyzed.

* **Data Quality**: Such as missing or inconsistent data, can arise from various sources. Therefore, data need to be cleaned and standardized at a fixed location.

* **Business Inteligence and Performance**: Organization need to make informed decision based on data analysis and doing so will be resource-intensive and slow down other business operation. Therefore a data warehouse provides optimized storage and retrieval of data. 

### **Operational databases - OLTP**
Core Operational database functionality includes: Gather data, Update data, Store data, retrieve data, Archive data

Operational databases are usually refered to as **OLTP - Online Transaction Processing**. OLTP has the following key characteristics:

* Processes a transaction according to rule.
* Performs all elements of a transaction in real time.
* Continually processes multiple transactions.

Some example of OLTP includes:
* Order tracking.
* Invoicing.
* Credit car processing.
* Banking.

**NOTE**

OLTP systems can be used to answer transactional questions, however, these raw transactional data are not really useful for business intelligence and thus **OLTP system can't be used to answer most analysis questions**.

For example: It can not search, sort, summarize large number of records, or if it does it will negatively impact OLTP system performance.

Therefore, OLTP systems are used to collect raw data for multi-dimensional analysis.

### **OLAP - Online Analytic Processing**

OLAP support multidimensional analysis with fast retrieval time and is equipped with calculation engine that can handle specialized multidimensional math.

---
**OLAP structure**

- **Dimension**: Categorically consistent view of data. There are two tests for dimensionality:
   * **Data about members can be compared**. For example, sales numbers of one product can be compared to sales number of another product.
   * **Data from members can be aggregated into summaries**. For example, Jan, Feb, Mar aggregate together as Q1.

- **OLAP CUBE**: multidimensional structure that stores and maintains discrete intersection values.

- **Hierarchy**: Organizes data by levels, each level in the hierarchy is the aggregate of the levels be neath it. For example:
  - Monthly data rolls up to quarters and years.
  - Cities roll up to regions and states.
  - Products roll up to product lines and groups.

- **Attribute**: descriptive non-hierarchy information that can affect our analysis such as model number, size, list price,...

- **Measures**: Any quantitive expression contained in an OLAP system. A measure is the data that's being analyzed across multiple dimensions, and there are four important properties of a measure:
   - Always a quantity or expression that yields a quantity.
   - Can take any quantitative format.
   - Can be derived from any original data source or calculation.
   - At least one measure required to perform OLAP analysis.


 For example:
  - Dollar sales of soda by month, by product, and by city.
  - Number of Soda sales in Vietnam from 2022 to 2023.

### **Joining data in DW**
- **Natural Join** is a join operation that combines two tables based on their common columns. A natural join is performed by comparing the values in the common columns of the two tables and producing a result set that combines the matched rows from both tables: 

``` SQL

--Suppose we have the following data

--CUSTOMER
customer_id | name     | email
------------|----------|---------------------
1           | John     | john@example.com
2           | Jane     | jane@example.com
3           | Michael  | michael@example.com

--ORDER
order_id | customer_id | product_id | order_date
---------|-------------|------------|----------------
1        | 1           | 100        | '2022-01-01'
2        | 2           | 200        | '2022-01-02'
3        | 1           | 300        | '2022-01-03'
4        | 3           | 100        | '2022-01-04'

--If we were to use natural join

SELECT *
FROM customer
NATURAL JOIN orders;

--The ouput would be
customer_id | name     | email                | order_id | product_id | order_date
------------|----------|----------------------|-----------|------------|----------------
1           | John     | john@example.com     | 1        | 100        | '2022-01-01'
1           | John     | john@example.com     | 3        | 300        | '2022-01-03'
2           | Jane     | jane@example.com     | 2        | 200        | '2022-01-02'
3           | Michael  | michael@example.com  | 4        | 100        | '2022-01-04'
```

* **Inner Join** is a type of join operation that combines two tables based on a matching condition specified in the ON or WHERE clause. An inner join selects only the matching rows from both tables and produces a result set that includes only the columns from both tables that are specified in the SELECT statement.

``` SQL
--Using the same example as above, if we were to use inner join such as:

SELECT orders.order_id, customers.name, orders.order_date
FROM orders
INNER JOIN customers
ON orders.customer_id = customers.customer_id;

--The output would be:

order_id | name     | order_date
---------|----------|----------------
1        | John     | '2022-01-01'
3        | John     | '2022-01-03'
2        | Jane     | '2022-01-02'
4        | Michael | '2022-01-04'
```

It is not hard to see that Inner Join provides more controls over retrieved data than Natural Join. Thus, Inner join would be a powerful and flexible tool for combining data from two or more tables.