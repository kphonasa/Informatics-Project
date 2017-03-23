# Informatics-Project

An interactive web application that enables a grocery store to provide a grocery delivery service. Includes a user interface for shoppers, and another for the grocerystore. The system supports multiple grocery stores setting up their own web applications.

Shoppers can browse through products, organized by category. They are able to add products to a shopping cart, and make a purchase either as guests, or by setting up an account for ease of keeping account information. Making a purchase (after selecting items in a shopping cart) involves entering name, address, email, payment information (but make sure you put a not telling users not to put real payment information!-this was for class), and preferred delivery time/date, which is constrained based on how quickly the store can turn around, a certain set of hours (maybe you don't deliver at 3 in the morning), and a reasonable limit on future deliveries (you can't schedule something to be delivered two years from now; maybe all deliveries are same or next-day). If users create an account, they are able to save their personal information to make future purchases more convenient. Shoppers receive updates on their order and are able to check on its status.

For stores, the web app supports the ability to set up a set of categories for groceries, and the addition of products under each category, with products being sold in specific units at a particular price. In addition, the app has a workflow component that supports the grocery store managing orders. The workflow includes steps such as: waiting to be filled, waiting to be delivered, out for delivery, delivered, and returned to the store (e.g., failed delivery). 

Accounts for shoppers and on the grocery side supports authentication. 
