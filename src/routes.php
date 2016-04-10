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
// Customers
$app->get('/departments', function ($request, $response, $args) {
  $this->logger->info("Customers page");
  $mapper = new DepartmentMapper($this->db);
  $customers = $customer_mapper->getDepartments();
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
    $data['address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
    $data['phone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

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
    $data['address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
    $data['phone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

    $mapper = new DepartmentMapper($this->db);
    $department = $mapper->getCustomerById($customer_id);
    $department->setName($data['name']);
    $department->setAddress($data['address']);
    $department->setPhoneNumber($data['phone']);
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