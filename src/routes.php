<?php
// Routes
$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Home");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

/**********************CUSTOMERS**********************/

// Customers
$app->get('/customers', function ($request, $response, $args) {
  $this->logger->info("Customers page");
  $customer_mapper = new CustomerMapper($this->db);
  $customers = $customer_mapper->getCustomers();
  return $this->renderer->render($response, 'customer/customers.phtml', [$args, "customers" => $customers]);
});

// New Customer
$app->get('/customer/new', function ($request, $response, $args) {
  $this->logger->info("Creating new customer");
  return $this->renderer->render($response, 'customer/customer.phtml', $args);
});

// New Customer POST
$app->post('/customer/new', function ($request, $response) {
    $this->logger->info("POST Creating new customer");
    $post_data = $request->getParsedBody();

    $customer_data = [];
    $customer_data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $customer_data['Address'] = filter_var($post_data['address'], FILTER_SANITIZE_STRING);
    $customer_data['Telephone'] = filter_var($post_data['phone'], FILTER_SANITIZE_STRING);

    $customer = new CustomerEntity($customer_data);
    $customer_mapper = new CustomerMapper($this->db);
    $customer_mapper->save($customer);
    $response = $response->withRedirect("/index.php/customers");
    return $response;
});

//Edit Customer GET
$app->get('/customer/{id}/edit', function ($request, $response, $args) {
  $customer_id = (int)$args['id'];
  $customer_mapper = new CustomerMapper($this->db);
  $customer = $customer_mapper->getCustomerById($customer_id);
  $this->logger->info("Edit customer " . $customer_id);
  return $this->renderer->render($response, 'customer/edit_customer.phtml', [$args, "customer" => $customer]);
});

// EDIT Customer POST
$app->post('/customer/edit', function ($request, $response) {
    $data = $request->getParsedBody();

    $customer_data = [];
    $customer_data['CustomerNumber'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $customer_data['Name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $customer_data['Address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
    $customer_data['Telephone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

    $customer_mapper = new CustomerMapper($this->db);
    $customer = $customer_mapper->getCustomerById($customer_data['CustomerNumber']);
    $this->logger->info("Updating customer " . $customer->getName());
    $customer->setName($customer_data['Name']);
    $customer->setAddress($customer_data['Address']);
    $customer->setPhoneNumber($customer_data['Telephone']);
    $customer_mapper->update($customer);
    $response = $response->withRedirect("/index.php/customers");
    return $response;
});

// Delete Customer
$app->get('/customer/{id}/delete', function ($request, $response, $args) {
  $customer_id = (int)$args['id'];
  $customer_mapper = new CustomerMapper($this->db);
  $customer = $customer_mapper->getCustomerById($customer_id);
  $this->logger->info("Customer retrieved " . $customer->getName());
  $customer_mapper->delete($customer);
  $response = $response->withRedirect("/index.php/customers");
  return $response;
});

/**********************DEPARTMENTS**********************/
// Departments
$app->get('/departments', function ($request, $response, $args) {
  $this->logger->info("Departments page");
  $mapper = new DepartmentMapper($this->db);
  $departments = $mapper->getDepartments();
  return $this->renderer->render($response, 'department/departments.phtml', [$args, "departments" => $departments]);
});

// New Department
$app->get('/department/new', function ($request, $response, $args) {
  $this->logger->info("Creating new department");
  return $this->renderer->render($response, 'department/department.phtml', $args);
});

// New department POST
$app->post('/department/new', function ($request, $response) {
    $this->logger->info("POST Creating new department");
    $post_data = $request->getParsedBody();

    $data = [];
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['RoomNumber'] = filter_var($post_data['room'], FILTER_SANITIZE_STRING);
    $data['FaxNumber'] = filter_var($post_data['fax'], FILTER_SANITIZE_STRING);
    $data['PhoneNumber1'] = filter_var($post_data['phoneOne'], FILTER_SANITIZE_STRING);
    $data['PhoneNumber2'] = filter_var($post_data['phoneTwo'], FILTER_SANITIZE_STRING);

    $department = new DepartmentEntity($data);
    $department_mapper = new DepartmentMapper($this->db);
    $this->logger->info("Creating new department " . $department->getName());
    $department_mapper->save($department);
    $response = $response->withRedirect("/index.php/departments");
    return $response;
});

//Edit Department GET
$app->get('/department/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new DepartmentMapper($this->db);
  $department = $mapper->getDepartmentById($id);
  $this->logger->info("Edit Department " . $id);
  return $this->renderer->render($response, 'department/edit_department.phtml', [$args, "department" => $department]);
});

// EDIT Department POST
$app->post('/department/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['Id'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['RoomNumber'] = filter_var($post_data['room'], FILTER_SANITIZE_STRING);
    $data['FaxNumber'] = filter_var($post_data['fax'], FILTER_SANITIZE_STRING);
    $data['PhoneNumber1'] = filter_var($post_data['phoneOne'], FILTER_SANITIZE_STRING);
    $data['PhoneNumber2'] = filter_var($post_data['phoneTwo'], FILTER_SANITIZE_STRING);

    $mapper = new DepartmentMapper($this->db);
    $department = $mapper->getDepartmentById($data['Id']);
    $department->setName($data['Name']);
    $department->setRoom($data['RoomNumber']);
    $department->setFax($data['FaxNumber']);
    $department->setPhoneOne($data['PhoneNumber1']);
    $department->setPhoneTwo($data['PhoneNumber2']);
    $mapper->update($department);
    $response = $response->withRedirect("/index.php/departments");
    return $response;
});

// Delete Department
$app->get('/department/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new DepartmentMapper($this->db);
  $department = $mapper->getDepartmentById($id);
  $this->logger->info("Deleting department " . $id);
  $mapper->delete($department);
  $response = $response->withRedirect("/index.php/departments");
  return $response;
});

// Query
$app->get('/department/query', function ($request, $response, $args) {
  $this->logger->info("Departments GET Query Page");
  $mapper = new DepartmentMapper($this->db);
  $departments = $mapper->getDepartments();
  return $this->renderer->render($response, 'queries/query_department.phtml', [$args, "departments" => $departments]);
});

// Query POST
$app->post('/department/query', function ($request, $response, $args) {
  $data = $request->getParsedBody();

  $deptId = (int)filter_var($data['department'], FILTER_SANITIZE_STRING);
  $this->logger->info("Departments POST Query Page");
  $mapper = new DepartmentMapper($this->db);
  $departments = $mapper->processQuery($deptId);
  return $this->renderer->render($response, 'queries/query_departments.phtml', [$args, "departments" => $departments]);
});

/**********************ORDERS**********************/
// Orders
$app->get('/orders', function ($request, $response, $args) {
  $this->logger->info("Orders page");
  $mapper = new OrderMapper($this->db);
  $orders = $mapper->getOrders();
  return $this->renderer->render($response, 'order/orders.phtml', [$args, "orders" => $orders]);
});

// New Order
$app->get('/order/new', function ($request, $response, $args) {
  $this->logger->info("Creating new order");
  return $this->renderer->render($response, 'order/order.phtml', $args);
});

// New Order POST
$app->post('/order/new', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['Balance'] = filter_var($post_data['total'], FILTER_SANITIZE_STRING);
    $data['DateOfPurchase'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['PaymentMethod'] = filter_var($post_data['method'], FILTER_SANITIZE_STRING);

    $order = new OrderEntity($data);

    $mapper = new OrderMapper($this->db);
    $mapper->save($order);
    $response = $response->withRedirect("/index.php/orders");
    return $response;
});

//Edit Order GET
$app->get('/order/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new OrderMapper($this->db);
  $order = $mapper->getOrderById($id);
  $this->logger->info("Edit Order " . $id);
  return $this->renderer->render($response, 'order/edit_order.phtml', [$args, "order" => $order]);
});

// EDIT Order POST
$app->post('/order/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['id'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['total'] = filter_var($post_data['total'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['method'] = filter_var($post_data['method'], FILTER_SANITIZE_STRING);

    $mapper = new OrderMapper($this->db);
    $order = $mapper->getOrderById($data['id']);

    $this->logger->info("POST Updating Order " . $order->getId());
    $order->setTotal( $data['total']);
    $order->setDate($data['date']);
    $order->setMethod($data['method']);
    $mapper->update($order);
    $response = $response->withRedirect("/index.php/orders");
    return $response;
});

// Delete Order
$app->get('/order/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new OrderMapper($this->db);
  $order = $mapper->getOrderById($id);
  $this->logger->info("Deleting order " . $id);
  $mapper->delete($order);
  $response = $response->withRedirect("/index.php/orders");
  return $response;
});

/**********************DEPENDANTS**********************/
// Dependants
$app->get('/dependants', function ($request, $response, $args) {
  $this->logger->info("Dependants page");
  $mapper = new DependantMapper($this->db);
  $dependants = $mapper->getDependants();
  return $this->renderer->render($response, 'dependant/dependants.phtml', [$args, "dependants" => $dependants]);
});

// New Dependant
$app->get('/dependant/new', function ($request, $response, $args) {
  $this->logger->info("Creating new dependant");
  $employee_mapper = new EmployeeMapper($this->db);
  $employees = $employee_mapper->getEmployees();
  return $this->renderer->render($response, 'dependant/dependant.phtml', [$args, "employees" => $employees]);
});

// New Dependant POST
$app->post('/dependant/new', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $care_giver_data = [];
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['SSN'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['DateOfBirth'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);
    $employee_id = (int)filter_var($post_data['employee'], FILTER_SANITIZE_STRING);

    $dependant = new DependantEntity($data);
    $mapper = new DependantMapper($this->db);
    $mapper->save($dependant);
    $mapper->updateCareGiver($employee_id, $dependant);

    $response = $response->withRedirect("/index.php/dependants");
    return $response;
});

//Edit Dependant GET
$app->get('/dependant/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new DependantMapper($this->db);
  $dependant = $mapper->getDependantById($id);
  $this->logger->info("Edit Dependant " . $id);
  return $this->renderer->render($response, 'dependant/edit_dependant.phtml', [$args, "dependant" => $dependant]);
});

// EDIT Dependant POST
$app->post('/dependant/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['SSN'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['DateOfBirth'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);

    $mapper = new DependantMapper($this->db);
    $dependant = $mapper->getDependantById($data['SSN']);
    $this->logger->info("POST Edit Dependant " . $dependant->getName());
    $dependant->setName( $data['Name']);
    $dependant->setDob($data['DateOfBirth']);
    $mapper->update($dependant);
    $response = $response->withRedirect("/index.php/dependants");
    return $response;
});

// Delete Dependant
$app->get('/dependant/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new DependantMapper($this->db);
  $dependant = $mapper->getDependantById($id);
  $this->logger->info("Deleting dependant " . $id);
  $mapper->delete($dependant);
  $response = $response->withRedirect("/index.php/dependants");
  return $response;
});

/**********************EMPLOYEE**********************/
// Employees
$app->get('/employees', function ($request, $response, $args) {
  $this->logger->info("Employees page");
  $employee_mapper = new EmployeeMapper($this->db);
  $employees = $employee_mapper->getEmployees();
  return $this->renderer->render($response, 'employee/employees.phtml', [$args, "employees" => $employees]);
});

// New Employee
$app->get('/employee/new', function ($request, $response, $args) {
  $this->logger->info("Creating new employee");
  $department_mapper = new DepartmentMapper($this->db);
  $departments = $department_mapper->getDepartments();
  return $this->renderer->render($response, 'employee/employee.phtml', [$args, "departments" => $departments]);
});

// New Employee POST
$app->post('/employee/new', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $department_data = [];
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['SSN'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['DateOfBirth'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);
    $data['Address'] = filter_var($post_data['address'], FILTER_SANITIZE_STRING);
    $data['Telephone'] = filter_var($post_data['phone'], FILTER_SANITIZE_STRING);
    $data['Position'] = filter_var($post_data['position'], FILTER_SANITIZE_STRING);
    $data['email'] = filter_var($post_data['email'], FILTER_SANITIZE_STRING);
    $department_data['deptId'] = filter_var($post_data['department'], FILTER_SANITIZE_STRING);
    $department_data['manager'] = filter_var($post_data['manager'], FILTER_SANITIZE_STRING);
    $department_data['start'] = filter_var($post_data['start'], FILTER_SANITIZE_STRING);
    $department_data['end'] = filter_var($post_data['end'], FILTER_SANITIZE_STRING);

    $employee = new EmployeeEntity($data);
    $mapper = new EmployeeMapper($this->db);
    $this->logger->info("Creating new employee");
    $mapper->save($employee, $department_data);
    $response = $response->withRedirect("/index.php/employees");
    return $response;
});

//Edit Employee GET
$app->get('/employee/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new EmployeeMapper($this->db);
  $employee = $mapper->getEmployeeById($id);
  $department_mapper = new DepartmentMapper($this->db);
  $departments = $department_mapper->getDepartments();
  $this->logger->info("Edit Employee " . $id);
  return $this->renderer->render($response, 'employee/edit_employee.phtml', [$args, "employee" => $employee, "departments" => $departments]);
});

//Details Employee GET
$app->get('/employee/{id}/details', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new EmployeeMapper($this->db);
  $employee = $mapper->getEmployeeById($id);
  $dependants = $mapper->getDependants($employee);
  $this->logger->info("Edit Employee " . $id);
  return $this->renderer->render($response, 'employee/details_employee.phtml', [$args, "employee" => $employee, "dependants" => $dependants]);
});

// EDIT Employee POST
$app->post('/employee/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $department_data = [];
    $data['Id'] = (int)filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['SSN'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['DateOfBirth'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);
    $data['Address'] = filter_var($post_data['address'], FILTER_SANITIZE_STRING);
    $data['Telephone'] = filter_var($post_data['phone'], FILTER_SANITIZE_STRING);
    $data['Position'] = filter_var($post_data['position'], FILTER_SANITIZE_STRING);
    $data['email'] = filter_var($post_data['email'], FILTER_SANITIZE_STRING);
    $department_data['deptId'] = filter_var($post_data['department'], FILTER_SANITIZE_STRING);
    $department_data['manager'] = filter_var($post_data['manager'], FILTER_SANITIZE_STRING);
    $department_data['start'] = filter_var($post_data['start'], FILTER_SANITIZE_STRING);
    $department_data['end'] = filter_var($post_data['end'], FILTER_SANITIZE_STRING);

    $mapper = new EmployeeMapper($this->db);
    $employee = $mapper->getEmployeeById($data['Id']);
    $employee->setName($data['Name']);
    $employee->setSin($data['SSN']);
    $employee->setDob($data['DateOfBirth']);
    $employee->setAddress($data['Address']);
    $employee->setPhone($data['Telephone']);
    $employee->setPosition($data['Position']);
    $employee->setEmail($data['email']);
    $mapper->update($employee, $department_data);
    $response = $response->withRedirect("/index.php/employees");
    return $response;
});

// Delete Employee
$app->get('/employee/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new EmployeeMapper($this->db);
  $employee = $mapper->getEmployeeById($id);
  $this->logger->info("Deleting employee " . $employee->getName());
  $mapper->delete($employee);
  $response = $response->withRedirect("/index.php/employees");
  return $response;
});

/**********************ITEMS**********************/
// Items
$app->get('/items', function ($request, $response, $args) {
  $this->logger->info("Items page");
  $item_mapper = new ItemMapper($this->db);
  $items = $item_mapper->getItems();
  return $this->renderer->render($response, 'item/items.phtml', [$args, "items" => $items]);
});

// New Item
$app->get('/item/new', function ($request, $response, $args) {
  $this->logger->info("Creating new item");
  $mapper = new ColorMapper($this->db);
  $colors = $mapper->getColors();
  return $this->renderer->render($response, 'item/item.phtml', [$args, "colors" => $colors]);
});

// New Item POST
$app->post('/item/new', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['Name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['Color'] = filter_var($post_data['color'], FILTER_SANITIZE_STRING);

    $item = new ItemEntity($data);
    $mapper = new ItemMapper($this->db);
    $mapper->save($item);
    $response = $response->withRedirect("/index.php/items");
    return $response;
});

//Edit Item GET
$app->get('/item/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new ItemMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Edit Item " . $id);
  $color_mapper = new ColorMapper($this->db);
  $colors = $color_mapper->getColors();
  return $this->renderer->render($response, 'item/edit_item.phtml', [$args, "item" => $item, "colors" => $colors]);
});

// EDIT Item POST
$app->post('/item/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['id'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['color'] = filter_var($post_data['color'], FILTER_SANITIZE_STRING);

    $mapper = new ItemMapper($this->db);
    $item = $mapper->getItemById($data['id']);
    $item->setName( $data['name']);
    $item->setColor($data['color']);
    $mapper->update($item);
    $response = $response->withRedirect("/index.php/items");
    return $response;
});

// Delete Item
$app->get('/item/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new ItemMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Deleting Item " . $id);
  $mapper->delete($item);
  $response = $response->withRedirect("/index.php/items");
  return $response;
});

/**********************IVENTORY**********************/
// Inventory
$app->get('/inventory', function ($request, $response, $args) {
  $this->logger->info("Inventory page");
  $mapper = new InventoryMapper($this->db);
  $items = $mapper->getItems();
  return $this->renderer->render($response, 'inventory/inventory.phtml', [$args, "inventoryItems" => $items]);
});

// Add Item GET
$app->get('/inventory/add', function ($request, $response, $args) {
  $this->logger->info("adding item");
  $mapper = new ItemMapper($this->db);
  $items = $mapper->getItems();
  return $this->renderer->render($response, 'inventory/add.phtml', [$args, "items" => $items]);
});

// Add Item POST
$app->post('/inventory/add', function ($request, $response) {
    $post_data = $request->getParsedBody();
    $data = [];

    $data['ItemId'] = (int)filter_var($post_data['item'], FILTER_SANITIZE_STRING);
    $data['Quantity'] = (int)filter_var($post_data['units'], FILTER_SANITIZE_STRING);
    $data['Price'] = filter_var($post_data['price'], FILTER_SANITIZE_STRING);
    $data['DateOfManufacture'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);

    $inventory_mapper = new InventoryMapper($this->db);
    $inventory_item = new InventoryEntity($data);
    $inventory_mapper->save($inventory_item);
    $response = $response->withRedirect("/index.php/inventory");
    return $response;
});

//Edit Inventory Item GET
$app->get('/inventory/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new InventoryMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Edit Inventory Item " . $id);
  return $this->renderer->render($response, 'inventory/edit_item.phtml', [$args, "item" => $item]);
});

// EDIT Inventory Item POST
$app->post('/inventory/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['id'] = (int)filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['units'] = (int)filter_var($post_data['units'], FILTER_SANITIZE_STRING);
    $data['price'] = filter_var($post_data['price'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);

    $mapper = new InventoryMapper($this->db);
    $item = $mapper->getItemById($data['id']);
    $item->setDate($data['date']);
    $item->setUnits($data['units']);
    $item->setPrice($data['price']);
    $mapper->update($item);
    $response = $response->withRedirect("/index.php/inventory");
    return $response;
});

// Delete Item
$app->get('/inventory/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new InventoryMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Deleting Item from inventory" . $id);
  $mapper->delete($item);
  $response = $response->withRedirect("/index.php/inventory");
  return $response;
});

/**********************SHIPMENT AKA PAYMENT**********************/
// Shipments AKA Payments
$app->get('/payments', function ($request, $response, $args) {
  $this->logger->info("Payment AKA Shipments page");
  $mapper = new PaymentMapper($this->db);
  $payments = $mapper->getPayments();
  return $this->renderer->render($response, 'payment/payments.phtml', [$args, "payments" => $payments]);
});

// Add payment GET
$app->get('/payment/add', function ($request, $response, $args) {
  $this->logger->info("adding payment item");
  $mapper = new OrderMapper($this->db);
  $orders = $mapper->getOrders();
  return $this->renderer->render($response, 'payment/add.phtml', [$args, "orders" => $orders]);
});

// Add payment POST
$app->post('/payment/add', function ($request, $response) {
    $post_data = $request->getParsedBody();
    $data = [];

    $data['OrderId'] = (int)filter_var($post_data['order'], FILTER_SANITIZE_STRING);
    $data['PaymentDate'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['Amount'] = filter_var($post_data['amount'], FILTER_SANITIZE_STRING);
    $payment_mapper = new PaymentMapper($this->db);
    
    $payment_item = new PaymentEntity($data);
    $payment_mapper->save($payment_item);
    $response = $response->withRedirect("/index.php/payments");
    return $response;
});

//Edit payment Item GET
$app->get('/payment/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new PaymentMapper($this->db);
  $payment = $mapper->getPaymentById($id);
  $this->logger->info("Edit payment " . $id);
  return $this->renderer->render($response, 'payment/edit_payment.phtml', [$args, "payment" => $payment]);
});

// EDIT payment Item POST
$app->post('/payment/edit', function ($request, $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    $data['id'] = (int)filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['amount'] = filter_var($post_data['amount'], FILTER_SANITIZE_STRING);

    $mapper = new PaymentMapper($this->db);
    $payment = $mapper->getPaymentById($data['id']);
    $payment->setDate($data['date']);
    $payment->setUnits($data['amount']);
    $mapper->save($payment);
    $response = $response->withRedirect("/index.php/payments");
    return $response;
});

// Delete payment
$app->get('/payment/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new PaymentMapper($this->db);
  $payment = $mapper->getPaymentById($id);
  $this->logger->info("Deleting payment" . $id);
  $mapper->delete($payment);
  $response = $response->withRedirect("/index.php/payments");
  return $response;
});

/*Produce a report on the top three selling products of the Company (in terms of
total value of sales) during the past 12 months. List (among other details) the
name of the item, number of orders placed, number of items sold. */

/**********************QUERY ROUTES**********************/
// Products 
$app->get('/products/query', function ($request, $response, $args) {
  $this->logger->info("products query");
  $mapper = new ProductQueryMapper($this->db);
  $products = $mapper->processQuery();
  return $this->renderer->render($response, 'queries/query_products.phtml', [$args, "products" => $products]);
});

/*
Produce a report on the best three customers of the Company (in terms of total
value of purchases by the customer) during the past 12 months. List details on the
customers as well as the types, the number and value of their orders. 
*/
// Customers
$app->get('/customers/query', function ($request, $response, $args) {
  $this->logger->info("Customers query");
  $mapper = new CustomerQueryMapper($this->db);
  //$products = $mapper->getProducts();
  $customers = $mapper->processQuery();
  return $this->renderer->render($response, 'queries/query_customers.phtml', [$args, "customers" => $customers]);
});

// Inventory
$app->get('/inventory/query', function ($request, $response, $args) {
  $this->logger->info("inventory GET Query Page");
  return $this->renderer->render($response, 'queries/query_inventory.phtml');
});

// Inventory POST
$app->post('/inventory/query', function ($request, $response, $args) {
  $data = $request->getParsedBody();
  $this->logger->info("Inventory POST query");
  $date = filter_var($data['myInput'], FILTER_SANITIZE_STRING);
  $mapper = new InventoryQueryMapper($this->db);
  $inventory = $mapper->processQuery($date);

  return $this->renderer->render($response, 'queries/query_inventory.phtml', [$args, "inventory" => $inventory]);
});

// Invoices
$app->get('/invoices/query', function ($request, $response, $args) {
  $this->logger->info("invoice GET Query Page");
  return $this->renderer->render($response, 'queries/query_invoices.phtml');
});

// Invoices POST
$app->post('/invoices/query', function ($request, $response, $args) {
  $data = $request->getParsedBody();
  $this->logger->info("invoices POST query");
  $name = filter_var($data['customerName'], FILTER_SANITIZE_STRING);
  $orderId = (int)filter_var($data['orderId'], FILTER_SANITIZE_STRING);

  $mapper = new InvoicesQueryMapper($this->db);
  $invoices = $mapper->processQuery($name, $orderId);

  return $this->renderer->render($response, 'queries/query_invoices.phtml', [$args, "invoices" => $invoices]);
});

// Payment
$app->get('/payments/query', function ($request, $response, $args) {
  $this->logger->info("Payments GET Query Page");

  $mapper = new PaymentMapper($this->db);
  $payments = $mapper->processQuery();

  return $this->renderer->render($response, 'queries/query_payments.phtml', [$args, "payments" => $payments]);
});