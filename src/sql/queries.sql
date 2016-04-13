-- Query 1
SELECT e.id, e.name
FROM Employee e
WHERE e.id IN 
    (SELECT he.id
        FROM HasEmployees he
        WHERE he.DeptId IN 
            (SELECT d.id
                FROM department d
                WHERE d.id = id))
-- Then with all the employee IDs, we grab from part-time. 
--     If there are records, then we know the status  will be part time and we calculate the earning.
--     else we select from full time and divide the salary by 12.
--     If there are no records, then there is a problem with the employee not being in both tables
-- Then we do a count on the dependents with every ids we grab.
SELECT COUNT(ed.name)
FROM EmployeeDependant ed
WHERE ed.SSN IN (
    SELECT icg.SSN
        FROM IsCareGiver icg
        WHERE icg.id = id)

-- Query #2
SELECT io.ItemId, SUM(io.Quantity), COUNT(io.OrderId)
FROM ItemsOrdered io
WHERE io.OrderId IN (
    SELECT o.Id
        FROM Orders o
        WHERE o.DateOfPurchase < DATE_ADD(NOW(), INTERVAL -12 MONTH))
GROUP BY io.ItemId
-- With the list of item IDs and the sum of their quantities, we can calculate the total value of each item.
-- Sort by total value,  and then output the 3 highest

-- Query #3

-- Query #4
select Name, sum(itemsordered.Quantity) as total_items_ordered,round(sum(Price*itemsordered.Quantity),2) as grand_total
from itemsordered natural join hasordered
join inventory on itemsordered.ItemId = inventory.ItemId
join customer on customer.CustomerNumber = hasordered.CNumber
join orders on itemsordered.OrderId = orders.Id
where orders.DateOfPurchase > date_sub(now(),interval 12 month)
group by CNumber
order by grand_total desc
limit 3;

-- Query #5
SELECT Customer.Name, HasOrdered.OrderId,(Orders.Balance - Payment.Amount) AS Oustanding_Payment
FROM Customer natural join HasOrdered
join Orders on HasOrdered.OrderId = Orders.Id
join Payment on HasOrdered.OrderId = Payment.OrderId
WHERE Payment.Amount < Orders.Balance;

-- Query #6
-- #queries for the invoice in this case I hardcoded the name and orderid but we would use 
-- #a search field from the php application
-- #return customer info
select Name,Telephone,Address from customer 
where name = 'Mike Tyson';
#returns order info
select DateOfPurchase,Balance from orders join hasordered on id = orderid
where CNumber = (select CustomerNumber from customer 
                            where name = 'Mike Tyson')
and orderId = 1;       
#returns the information on each item of the order
select name, itemsordered.Quantity, price
from itemsordered
join item on itemsordered.ItemId = item.Id
join inventory on item.id = inventory.ItemId
where OrderId = 1;
#returns information about the payments made (WILL NOT MAKE SENSE I DIDNT CALCULATE THE ACTUAL TOTALS)
select PaymentDate,amount from payment
where OrderId = 1;