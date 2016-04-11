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
    $response = $response->withRedirect("/customers");
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
  $response = $response->withRedirect("/customers");
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
    $data['PhoneNumber2'] = filter_var($post_data['phoneOne'], FILTER_SANITIZE_STRING);

    $department = new DepartmentEntity($data);
    $department_mapper = new DepartmentMapper($this->db);
    $department_mapper->save($department);
    $response = $response->withRedirect("/departments");
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
    $response = $response->withRedirect("/departments");
    return $response;
});

// Delete Department
$app->post('/department/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new DepartmentMapper($this->db);
  $department = $mapper->getDepartmentById($id);
  $this->logger->info("Deleting department " . $id);
  $mapper->delete($department);
  return $this->renderer->render($response, 'department/departments.phtml', $args);
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
$app->post('/order/new', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['total'] = filter_var($post_data['total'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['method'] = filter_var($post_data['method'], FILTER_SANITIZE_STRING);

    $order = new OrderEntity($data);
    $mapper = new OrderMapper($this->db);
    $mapper->save($order);
    $response = $response->withRedirect("/orders");
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
$app->post('/order/edit', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['total'] = filter_var($post_data['total'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['method'] = filter_var($post_data['method'], FILTER_SANITIZE_STRING);

    $mapper = new OrderMapper($this->db);
    $order = $mapper->getOrderById($data['id']);
    $order->setTotal( $data['total']);
    $order->setDate($data['date']);
    $order->setMethod($data['method']);
    $mapper->save($order);
    $response = $response->withRedirect("/orders");
    return $response;
});

// Delete Order
$app->post('/order/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new OrderMapper($this->db);
  $order = $mapper->getOrderById($id);
  $this->logger->info("Deleting order " . $id);
  $mapper->delete($order);
  return $this->renderer->render($response, 'order/orders.phtml', $args);
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
  return $this->renderer->render($response, 'dependant/dependant.phtml', $args);
});

// New Dependant POST
$app->post('/dependant/new', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['sin'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['dob'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);

    $dependant = new DependantEntity($data);
    $mapper = new DependantMapper($this->db);
    $mapper->save($dependant);
    $response = $response->withRedirect("/dependants");
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
$app->post('/dependant/edit', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['sin'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['dob'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);

    $mapper = new DependantMapper($this->db);
    $dependant = $mapper->getDependantById($data['id']);
    $dependant->setName( $data['name']);
    $dependant->setSin($data['sin']);
    $dependant->setDob($data['dob']);
    $mapper->save($dependant);
    $response = $response->withRedirect("/dependants");
    return $response;
});

// Delete Dependant
$app->post('/dependant/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new DependantMapper($this->db);
  $dependant = $mapper->getDependantById($id);
  $this->logger->info("Deleting dependant " . $id);
  $mapper->delete($dependant);
  return $this->renderer->render($response, 'dependant/dependants.phtml', $args);
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
  $dependant_mapper = new DependantMapper($this->db);
  $dependants = $dependant_mapper->getDependants();
  return $this->renderer->render($response, 'employee/employee.phtml', [$args, "dependants" => $dependants]);
});

// New Employee POST
$app->post('/employee/new', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['sin'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['dob'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);
    $data['address'] = filter_var($post_data['address'], FILTER_SANITIZE_STRING);
    $data['phone'] = filter_var($post_data['phone'], FILTER_SANITIZE_STRING);
    $data['position'] = filter_var($post_data['position'], FILTER_SANITIZE_STRING);

    $employee = new EmployeeEntity($data);
    $mapper = new EmployeeMapper($this->db);
    $mapper->save($employee);
    $response = $response->withRedirect("/employees");
    return $response;
});

//Edit Employee GET
$app->get('/employee/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new EmployeeMapper($this->db);
  $employee = $mapper->getEmployeeById($id);
  $this->logger->info("Edit Employee " . $id);
  return $this->renderer->render($response, 'employee/edit_employee.phtml', [$args, "employee" => $employee]);
});

// EDIT Employee POST
$app->post('/employee/edit', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['sin'] = filter_var($post_data['sin'], FILTER_SANITIZE_STRING);
    $data['dob'] = filter_var($post_data['dob'], FILTER_SANITIZE_STRING);
    $data['address'] = filter_var($post_data['address'], FILTER_SANITIZE_STRING);
    $data['phone'] = filter_var($post_data['phone'], FILTER_SANITIZE_STRING);
    $data['position'] = filter_var($post_data['position'], FILTER_SANITIZE_STRING);

    $mapper = new EmployeeMapper($this->db);
    $employee = $mapper->getEmployeeById($data['id']);
    $employee->setName( $data['name']);
    $employee->setSin($data['sin']);
    $employee->setDob($data['dob']);
    $employee->setAddress($data['address']);
    $employee->setPhone($data['phone']);
    $employee->setPosition($data['position']);
    $mapper->save($employee);
    $response = $response->withRedirect("/employees");
    return $response;
});

// Delete Employee
$app->post('/employee/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new EmployeeMapper($this->db);
  $employee = $mapper->getEmployeeById($id);
  $this->logger->info("Deleting employee " . $id);
  $mapper->delete($employee);
  return $this->renderer->render($response, 'employee/employees.phtml', $args);
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
  return $this->renderer->render($response, 'item/item.phtml', $args);
});

// New Item POST
$app->post('/item/new', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['color'] = filter_var($post_data['color'], FILTER_SANITIZE_STRING);

    $item = new ItemEntity($data);
    $mapper = new ItemMapper($this->db);
    $mapper->save($item);
    $response = $response->withRedirect("/items");
    return $response;
});

//Edit Item GET
$app->get('/item/{id}/edit', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new ItemMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Edit Item " . $id);
  return $this->renderer->render($response, 'item/edit_item.phtml', [$args, "item" => $item]);
});

// EDIT Item POST
$app->post('/item/edit', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['name'] = filter_var($post_data['name'], FILTER_SANITIZE_STRING);
    $data['color'] = filter_var($post_data['color'], FILTER_SANITIZE_STRING);

    $mapper = new ItemMapper($this->db);
    $item = $mapper->getItemById($data['id']);
    $item->setName( $data['name']);
    $item->setColor($data['color']);
    $mapper->save($item);
    $response = $response->withRedirect("/items");
    return $response;
});

// Delete Item
$app->post('/item/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new ItemMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Deleting Item " . $id);
  $mapper->delete($item);
  return $this->renderer->render($response, 'item/items.phtml', $args);
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
$app->post('/inventory/add', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();
    $data = [];

    $data['itemId'] = (int)filter_var($post_data['item'], FILTER_SANITIZE_STRING);
    $data['units'] = (int)filter_var($post_data['units'], FILTER_SANITIZE_STRING);
    $data['price'] = filter_var($post_data['price'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);

    $item_mapper = new ItemMapper($this->db);
    $inventory_mapper = new InventoryMapper($this->db);
    
    $item = $item_mapper->getItemById($data['itemId']);
    $data['item'] = $item;
    $inventory_item = new InventoryEntity($data);
    $inventory_mapper->save($inventory_item);
    $response = $response->withRedirect("/inventory");
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
$app->post('/inventory/edit', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = (int)filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['units'] = (int)filter_var($post_data['units'], FILTER_SANITIZE_STRING);
    $data['price'] = filter_var($post_data['price'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);

    $mapper = new InventoryMapper($this->db);
    $item = $mapper->getItemById($data['id']);
    $item->setDate($data['date']);
    $item->setUnits($data['units']);
    $item->setPrice($data['price']);
    $mapper->save($item);
    $response = $response->withRedirect("/inventory");
    return $response;
});

// Delete Item
$app->post('/inventory/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new InventoryMapper($this->db);
  $item = $mapper->getItemById($id);
  $this->logger->info("Deleting Item from inventory" . $id);
  $mapper->delete($item);
  return $this->renderer->render($response, 'inventory/inventory.phtml', $args);
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
$app->post('/payment/add', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();
    $data = [];

    $data['orderId'] = (int)filter_var($post_data['order'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['amount'] = filter_var($post_data['amount'], FILTER_SANITIZE_STRING);

    $order_mapper = new OrderMapper($this->db);
    $payment_mapper = new PaymentMapper($this->db);
    
    $order = $order_mapper->getOrderById($data['orderId']);
    $data['order'] = $order;
    $payment_item = new PaymentEntity($data);
    $payment_mapper->save($payment_item);
    $response = $response->withRedirect("/payments");
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
$app->post('/payment/edit', function (Request $request, Response $response) {
    $post_data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = (int)filter_var($post_data['id'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($post_data['date'], FILTER_SANITIZE_STRING);
    $data['amount'] = filter_var($post_data['amount'], FILTER_SANITIZE_STRING);

    $mapper = new PaymentMapper($this->db);
    $payment = $mapper->getPaymentById($data['id']);
    $payment->setDate($data['date']);
    $payment->setUnits($data['amount']);
    $mapper->save($payment);
    $response = $response->withRedirect("/payments");
    return $response;
});

// Delete payment
$app->post('/payment/{id}/delete', function ($request, $response, $args) {
  $id = (int)$args['id'];
  $mapper = new PaymentMapper($this->db);
  $payment = $mapper->getPaymentById($id);
  $this->logger->info("Deleting payment" . $id);
  $mapper->delete($payment);
  return $this->renderer->render($response, 'payment/payments.phtml', $args);
});

/*Produce a report on the top three selling products of the Company (in terms of
total value of sales) during the past 12 months. List (among other details) the
name of the item, number of orders placed, number of items sold. */

/**********************PAYMENT QUERY ROUTES**********************/
// Products 
$app->get('/products/query', function ($request, $response, $args) {
  $this->logger->info("products query");
  $mapper = new ProductQueryMapper($this->db);
  $products = $mapper->getProducts();
  return $this->renderer->render($response, 'queries/query_products.phtml', [$args, "products" => $products]);
});

