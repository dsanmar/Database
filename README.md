# Intro to Database Management System 

Submitted by: **Maria Santos Perez**

## Summary

This project is a simple web-based order management system developed using PHP. It allows customers to view, place, and manage their product orders. The project includes basic authentication, order history management, and the ability to place and modify orders. This project was designed to help understand the core concepts of database interaction and handling user orders through a simple, barebone interface **

If I had to describe this project in three (3) emojis, they would be: **✨🖥️ ☺️**

## Application Features

The following REQUIRED features are completed:

**Authentication**
- [X] Users can log in using their credentials stored in the Customers database
- [X] Error messages are shown for invalid logins or incorrect passwords
- [X] Successfully logged-in users can access their homepage and order management functions

**User Homepage**
- [X] Displays the user's personal information: name, birthday, age, address, and IP address.
- [X] Shows the logged-in customer's image.
- [X] Displays a message indicating whether the user is logging in from the Kean domain.
- [X] Provides links to: "Order Product", "View, change, cancel my order history", "Logout"

**Order Product**
- [X] Displays all products available for purchase in a table format with headers.
- [X] Customers can input the desired quantity to place an order. The quantity is required to proceed with the order.

**View, Change, Cancel Orders**
- [X] Shows the logged-in customer's past orders in a table format.
- [X] Displays order details such as order ID, product name, etc.
- [X] Provides functionality to cancel an order or change the quantity for each order.
- [X] Uses the GET method for easy testing of customer actions like order viewing and modification.

**Place Orders**
- [X] Validates order input for errors such as non-integer quantities or quantities exceeding the available stock.
- [X] Adds valid orders to the Order table in the database

## Video Demo

Here's a video / GIF that demos some of the app's implemented features:

![Kapture 2024-09-21 at 22 48 17](https://github.com/user-attachments/assets/ee0e1c0e-9aaf-4d6b-876e-0502f51db988)

GIF created with **Kap**

<!-- Recommended tools:
- [Kap](https://getkap.co/) for macOS
- [peek](https://github.com/phw/peek) for Linux. -->

## Notes


## License

Copyright **2023** **Maria Santos Perez**
