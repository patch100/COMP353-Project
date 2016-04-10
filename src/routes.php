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
$app->post('/customer/new', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $customer_data = [];
    $customer_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $customer_data['address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
    $customer_data['phone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

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
$app->post('/customer/edit', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $customer_data = [];
    $customer_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $customer_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $customer_data['address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
    $customer_data['phone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

    $customer_mapper = new CustomerMapper($this->db);
    $customer = $customer_mapper->getCustomerById($customer_id);
    $customer->setName($customer_data['name']);
    $customer->setAddress($customer_data['address']);
    $customer->setPhoneNumber($customer_data['phone']);
    $customer_mapper->save($customer);
    $response = $response->withRedirect("/customers");
    return $response;
});

// Delete Customer
$app->post('/customer/{id}/delete', function ($request, $response, $args) {
  $customer_id = (int)$args['id'];
  $customer = $customer_mapper->getCustomerById($customer_id);
  $this->logger->info("Deleting customer " . $customer_id);
  $customer_mapper->delete($customer);
  return $this->renderer->render($response, 'customer/customers.phtml', $args);
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

// New Department POST
$app->post('/department/new', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $data['room'] = filter_var($data['room'], FILTER_SANITIZE_STRING);
    $data['fax'] = filter_var($data['fax'], FILTER_SANITIZE_STRING);
    $data['phoneOne'] = filter_var($data['phoneOne'], FILTER_SANITIZE_STRING);
    $data['phoneTwo'] = filter_var($data['phoneOne'], FILTER_SANITIZE_STRING);

    $department = new DepartmentEntity($data);
    $mapper = new DepartmentMapper($this->db);
    $mapper->save($department);
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
$app->post('/department/edit', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $data['room'] = filter_var($data['room'], FILTER_SANITIZE_STRING);
    $data['fax'] = filter_var($data['fax'], FILTER_SANITIZE_STRING);
    $data['phoneOne'] = filter_var($data['phoneOne'], FILTER_SANITIZE_STRING);
    $data['phoneTwo'] = filter_var($data['phoneOne'], FILTER_SANITIZE_STRING);

    $mapper = new DepartmentMapper($this->db);
    $department = $mapper->getDepartmentById($data['id']);
    $department->setName($data['name']);
    $department->setRoom($data['room']);
    $department->setFax($data['fax']);
    $department->setPhoneOne($data['phoneOne']);
    $department->setPhoneTwo($data['phoneTwo']);
    $mapper->save($department);
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
    $data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['total'] = filter_var($data['total'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($data['date'], FILTER_SANITIZE_STRING);
    $data['method'] = filter_var($data['method'], FILTER_SANITIZE_STRING);

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
    $data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $data['total'] = filter_var($data['total'], FILTER_SANITIZE_STRING);
    $data['date'] = filter_var($data['date'], FILTER_SANITIZE_STRING);
    $data['method'] = filter_var($data['method'], FILTER_SANITIZE_STRING);

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

// New Dependants
$app->get('/dependant/new', function ($request, $response, $args) {
  $this->logger->info("Creating new dependant");
  return $this->renderer->render($response, 'dependant/dependant.phtml', $args);
});

// New Dependant POST
$app->post('/dependant/new', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $data['sin'] = filter_var($data['sin'], FILTER_SANITIZE_STRING);
    $data['dob'] = filter_var($data['dob'], FILTER_SANITIZE_STRING);

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
    $data = $request->getParsedBody();

    $data = [];
    // TODO: SET CORRECT PARAMS
    $data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $data['sin'] = filter_var($data['sin'], FILTER_SANITIZE_STRING);
    $data['dob'] = filter_var($data['dob'], FILTER_SANITIZE_STRING);

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

/**********************DEPENDANTS**********************/