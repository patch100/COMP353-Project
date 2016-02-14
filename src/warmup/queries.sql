use comp353_warmup;
# Query 1
SELECT c.cName
FROM Customer c, Product p, OrderDetail od, Shippment s
WHERE c.cNumber = s.cNumber AND
	s.oNumber = od.oNumber AND
	od.pNumber = p.pNumber AND
	p.pName LIKE '%ware%';
# Query 2
# Query 3
# Query 4
# Query 5
# Query 6
# Query 7