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
  return $this->renderer->render($response, 'customer/customers.phtml', $args);
});

// Edit Customer GET
// $app->get('/customer/{id}/edit', function ($request, $response, $args) {
//   $customer_id = (int)$args['id'];
//   $this->logger->info("Edit customer " . $customer_id);
//   return $this->renderer->render($response, 'customer.phtml', $args);
// })->setName("customer-edit");

// // EDIT Customer POST
// $app->post('/customer/edit', function (Request $request, Response $response) {
//     $data = $request->getParsedBody();

//     $customer_data = [];
//     $customer_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
//     $customer_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
//     $customer_data['address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
//     $customer_data['phone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

//     $customer = new CustomerEntity($customer_data);
//     $customer_mapper = new CustomerMapper($this->db);
//     $customer_mapper->save($customer);
//     $response = $response->withRedirect("/customers");
//     return $response;
// });

// // Delete Customer
// $app->post('/customer/{id}/delete', function ($request, $response, $args) {
//   $customer_id = (int)$args['id'];
//   $this->logger->info("Deleting customer " . $customer_id);
//   return $this->renderer->render($response, 'customers.phtml', $args);
// })->setName("customer-delete");

// // New Customer POST
// $app->post('/customer/new', function (Request $request, Response $response) {
//     $data = $request->getParsedBody();

//     $customer_data = [];
//     $customer_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
//     $customer_data['address'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
//     $customer_data['phone'] = filter_var($data['phone'], FILTER_SANITIZE_STRING);

//     $customer = new CustomerEntity($customer_data);
//     $customer_mapper = new CustomerMapper($this->db);
//     $customer_mapper->save($customer);
//     $response = $response->withRedirect("/customers");
//     return $response;
// });

// New Customer
$app->get('/customer/new', function ($request, $response, $args) {
  $this->logger->info("Creating new customer");
  return $this->renderer->render($response, 'customer.phtml', $args);
})->setName("customer-new");