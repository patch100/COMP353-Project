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
$app->get('/index.php/customers', function ($request, $response, $args) {
  $this->logger->info("Customers page");
  $customer_mapper = new CustomerMapper($this->db);
  $customers = $customer_mapper->getCustomers();
  return $this->renderer->render($response, 'customer/customers.phtml', [$args, "customers" => $customers]);
});

// New Customer
$app->get('/index.php/customer/new', function ($request, $response, $args) {
  $this->logger->info("Creating new customer");
  return $this->renderer->render($response, 'customer/customer.phtml', $args);
});

// New Customer POST
$app->post('/index.php/customer/new', function (Request $request, Response $response) {
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
$app->get('/index.php/customer/{id}/edit', function ($request, $response, $args) {
  $customer_id = (int)$args['id'];
  $customer_mapper = new CustomerMapper($this->db);
  $customer = $customer_mapper->getCustomerById($customer_id);
  $this->logger->info("Edit customer " . $customer_id);
  return $this->renderer->render($response, 'customer/edit_customer.phtml', [$args, "customer" => $customer]);
});

// EDIT Customer POST
$app->post('/index.php/customer/edit', function (Request $request, Response $response) {
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
$app->post('/index.php/customer/{id}/delete', function ($request, $response, $args) {
  $customer_id = (int)$args['id'];
  $customer = $customer_mapper->getCustomerById($customer_id);
  $this->logger->info("Deleting customer " . $customer_id);
  $customer_mapper->delete($customer);
  return $this->renderer->render($response, 'customer/customers.phtml', $args);
});

/**********************DEPARTMENTS**********************/