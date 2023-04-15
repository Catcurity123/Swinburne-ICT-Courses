
# Concurrent problems in database



## Description:
Concurrent problems in database refer to issues that can arise when **multiple transactions are accessing the same data concurrently**. These issues can lead to inconsistencies, conflicts, or errors in the data, and can affect the performance, reliability, and availability of the database system.

### **Common problems**
- **Data Inconsistency**: When **multiple transactions are accessing or modifying the sane data concurrently**, it can lead to inconsistencies in the data if the database is not configured to handle concurrency.

- **Deadlocks**: This refers to **the situation where two or more transactions are waiting for each other to release locks on data items** that they need to access or modify.

- **Starvation**: occurs when a transaction is unable to acquire the locks it needs to access or modify data.

- **Performance**: When multiple transactions are accessing the same data concurrently. it can lead to contention for resources such as disk I/O, memory, or CPU.

---

### **Data Inconsistency**
**Lost Update**: refers to the situation when one transaction overwrites the outcome of another transaction. This is a serious problem that will be detrimental to data integrity.

**Dirty Read**: is when a second transaction reads uncommitted data, this will not be serious if the second transaction does not modify the database based on the uncommitted data.

**Phantom Read**: refers to the situation when one or multiple results appear from a query the second times it is performed. This happens as between the two transactions, some INSERT or DELETE statements weere performed. This can lead to data inconsistencies.

**Fuzzy Read**: refers to the situation when the query retrieves a different data from its initial tries. This may happen because some modification by another transaction were performed and it can lead to data inconsistencies.

### **Locking**
Concurrency problems can be overcome using **locking** which can be placed on Databases, Tables, Rows,...

**Locking** refers to the mechanism used to control access to data by multiple transactions or processes. A lock ensures that only one transaction can access or modify a data item at a time, preventing concurrent access or modification by other transactions.

However, if ywo transaction may want to update the same database at the same time, one transaction will have to wait for another to complete, and this will slow down the transaction.

---

### **Isolation**
**Isolation** refers to the degree to which transactions are isolated from each other. Its levels determine how much one transaction can see the changes made by other transaction. There are 4 levels:
- **Read Uncommitted**: This refers to the state when a transaction can view other modified data even if it has yet to be committed. This will lead to **dirty reads, fuzzy reads ,and other inconsistencies**.
**EXAMPLE**
```SQL
--Transaction T2:
BEGIN TRANSACTION;
UPDATE employees SET salary = salary + 10000 WHERE employee_id = 123;

--Transaction T1:
SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
BEGIN TRANSACTION;
SELECT * FROM employees WHERE salary >= 50000;
COMMIT;

--In this example, transaction 1 can still see the uncommitted data from transaction 2 as the tranaction is performed in Uncommitted Read.
--This happens because the database system does not use any locks or read-consistent mechanisms to prevent Read Uncommitted.
--This means that RU will not prevent Dirty Read, Fuzzy Read or Phantom Read
```


- **Read Commited**: refers to the state when a transaction can only read committed transaction from other transactions. This prevents dirty reads, but can lead to fuzzy read.

**Example**
```SQL
--Transaction T2:
BEGIN TRANSACTION;
UPDATE employees SET salary = salary + 10000 WHERE employee_id = 123;


--Transaction T1:

SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
BEGIN TRANSACTION;
SELECT * FROM employees WHERE salary >= 50000;
COMMIT;

--In this example, transaction 1 can not see the uncommitted data from transaction 2.
--This can prevent dirty read, however, fuzzy read and phantom read is stilla problem.
```



- **Repeatable Read**: In this isolation level. we can only read committed data from other transactions, and any data that has been read by a transaction will remain the same throughout the transaction, even if other transactions modify the same data. This can prevent both dirty read and fuzzy read but can lead to **phantom read**.

**Example**
```SQL
--Transaction T1:
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
BEGIN TRANSACTION;
SELECT * FROM employees WHERE salary >= 50000;
COMMIT;

--Transaction T2:
BEGIN TRANSACTION;
UPDATE employees SET salary = salary + 10000 WHERE employee_id = 123;
COMMIT;

--In this example, suppose the two transactions happen at the same time, transaction 1 only read the unupdated data before transaction 2. This is done via shared locks and other mechanisms.
--This will effectively eliminate fuzzy read and dirty read, however, phantomread where DELETE or INSERT statements involve is still a problem.
```
- **Serializable**: is the highest level of isolation, in which transactions are completely isolated from each other. This level provides the strongest guarantees of consistency and accuracy at the expense of lower concurrency.

**Example**
```SQL
--Transaction T1:
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;
BEGIN TRANSACTION;
SELECT SUM(quantity) FROM orders WHERE product_id = 123;
COMMIT;

--Transaction T2:
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;
BEGIN TRANSACTION;
UPDATE orders SET quantity = quantity + 1 WHERE product_id = 123 AND order_date = '2022-03-17';
COMMIT;y + 10000 WHERE employee_id = 123;
COMMIT;

--In this example, as two transactions are at the highest level of transaction, shared locks and other mechanisms applied on the database prevent T2 from modifying any data that T1 is reading and subsequently prevent T1 from reading any data that T2 is modifying.
-- In the end, when both transaction commit their changes, the database system releases all the locks.
--This will mean that dirty read, fuzzy read and phantom read is no longer a problem in thislevel of isolation.
```

---

**NOTE**

However, it is important to note that using high level of isolation comes with many trade-off in concurrency.
This is because when high level of isolation is applied, more locks and other concurrency control mechanisms are required to ensure data consistency.

 **This will result in higher contention for resources and lower concurrency** which can impact the performance and scalability of the system.

 **It will also mean that the complexity and difficulty of application development and maintenance** will rise.

 Therefore, striking a balance between concurrency and data consistency is an honored task for DB practioner, there are some points to be remembered:

 1. **Understand the requirement and the scope of the application**: The level of concurrency and data consistency needed in a database system depends on the specific requirement of the application. **An application that handles financial transactions may require a higher level of data consistency than an application that handles social media posts.**

 2. **Chose an appropriate isolation level**: The choice of isolation level can have a significant impact on the balance between concurrency and data consistency.

 3. **Use locking and other concurrency control mechanism judiciously:** Locking and other concurrency control mechanisms can help ensure data consistency and prevent conflicts, but they can also reduce concurrency.

 4. **Optimize queries and transactions:** Optimizing queries and transactions can help reduce contention for resources and improve performance.

 5. **Consider using multi-version concurrency control (MVCC)**: MVCC is a concurrency control mechanism that allows multiple versions of a data item to exist at the same time, rather than using locks to prevent conflicts
