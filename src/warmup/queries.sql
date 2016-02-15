use comp353_warmup;
# Query 1
SELECT c.cName
FROM Customer c, Product p, OrderDetail od, Shippment s
WHERE c.cNumber = s.cNumber AND
	s.oNumber = od.oNumber AND
	od.pNumber = p.pNumber AND
	p.pName LIKE '%ware%';

# Query 2
SELECT *
FROM Product p, OrderDetail od
WHERE od.pNumber = p.pNumber AND
od.oNumber = 3;

# Query 3
SELECT c.cName
FROM Customer c
WHERE (SELECT COUNT(od.pNumber)
		FROM OrderDetail od, Shippment s
		WHERE od.oNumber = s.oNumber AND
			s.cNumber = c.cNumber
	) = 3;

# Query 4
SELECT p.pName, m.mName
FROM Product p, Manufacturer m
WHERE p.mNumber = m.mNumber AND p.pUnitprice > 100;  

# Query 5
SELECT DISTINCT cName
FROM Customer
WHERE cName not in (
  SELECT DISTINCT c.cName
  FROM Customer c, Shippment s, OrderDetail od
  WHERE c.cNumber = s.cNumber AND
        s.oNumber = od.oNumber AND
        od.pNumber in (
          SELECT DISTINCT p.pNumber
          FROM Product p, Customer c, Shippment s, OrderDetail od
          WHERE c.cName LIKE 'Frank%' AND
            c.cNumber = s.cNumber AND
            s.oNumber = od.oNumber AND
            p.pNumber = od.pNumber));

# Query 6
SELECT c.cName
From Customer c
WHERE (
  SELECT COUNT(od.pNumber)
	FROM Customer c, Shippment s, OrderDetail od
	WHERE c.cNumber = s.cNumber 
  AND s.oNumber = od.oNumber ) = (SELECT COUNT(*) FROM Product);

# Query 7
select c.cname, min(o.oQuantity), max(o.oQuantity) 
from shippment as s join orderdetail as o on s.oNumber = o.oNumber 
join customer as c on c.cnumber = s.cnumber
group by c.cname;