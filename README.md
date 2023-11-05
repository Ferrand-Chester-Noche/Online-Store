# Online Store Web Application

## Developers
-Odedjinn Suba
-Hannah Buizon
-Ferrand Noche

## Overview

This project is a fully functional online store web application designed to implement a 3-tier web architecture. It provides a platform for sellers to manage their products and for buyers to browse, purchase, and manage their shopping carts. Additionally, it includes user authentication and registration features.

## Specifications

### Users

#### Seller
- **Add/Edit/Delete Products**: Sellers can add, edit, and delete various products in their inventory. This functionality allows them to keep their product listings up to date.

- **View Sales and Users**: Sellers can view information about their sales and the users who have purchased their products. This helps sellers keep track of their transactions.

#### Buyer
- **Browse/Search Products**: Buyers can view and search through a wide range of available products in the store. This feature enables easy product discovery.

- **Add Items to Cart**: Buyers can add products to their shopping cart. This allows them to collect items they intend to purchase in a single place.

- **Purchase Products**: Buyers can complete the purchase process, including providing payment information and confirming their orders.

- **Login/Sign-up**: The application provides a login page where users can sign in with their existing accounts or sign up for new ones. User authentication is a fundamental part of the system.

### User Verification
- **Email Verification**: When a user registers, they receive an email containing a verification code. Users must input this code on the registration page or click a verification link in the email to verify their accounts.

- **Unverified Accounts**: Users with unverified accounts will not be able to log in until they complete the verification process.

## Project Structure

The project is organized into three main tiers, following a 3-tier architecture:

1. **Presentation Tier**: This tier is responsible for user interaction. It includes the user interface, user authentication, and navigation. Users can log in, browse products, add items to their carts, and complete purchases.

2. **Application Tier**: In this tier, the application handles business logic and user actions. It manages product listings, user profiles, and the shopping cart.

3. **Data Tier**: This tier is responsible for data storage and retrieval. It includes databases for storing product information, user profiles, and transaction data.

## Technologies Used

- **Front-end**: HTML, CSS, JavaScript, and a modern front-end framework/library (e.g., React, Angular, or Vue.js).

- **Back-end**: A server-side technology or framework (e.g., Node.js with Express, Django, Ruby on Rails, ASP.NET, or Java Spring).

- **Database**: A relational database management system (e.g., MySQL, PostgreSQL, or SQLite).

- **Authentication**: A secure user authentication system, possibly using OAuth or JWT.

- **Email Services**: Integration with an email service for sending verification emails (if implementing the additional feature).

## Usage

To run the application:

1. Clone the repository to your local machine.
2. Set up the necessary dependencies for the front-end and back-end.
3. Configure the database.
4. Start the application.
5. Access the application through a web browser.

This Online Store Web Application provides a comprehensive e-commerce solution with user-friendly interfaces for both sellers and buyers, making it a robust and efficient platform for online shopping.
