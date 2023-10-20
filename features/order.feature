Feature: Order service


  Scenario: Create an order
    When I create an order with dataset: "order data 1"
    Then I can see order ID of "order data 1"


  Scenario: Change order status
    Given Order created dataset: "order data 1"
    When I change the status of "order data 1" to "FULLFILLED"
    Then I can see order status of "order data1" is "FULLFILLED"


  Scenario: List orders
    Given 1000 orders are created
    When I list orders filter
