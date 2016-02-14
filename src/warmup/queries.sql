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
# Query 5
# Query 6
# Query 7