# Job/Internship Offer Extractor

## Overview

This web application leverages AI to extract relevant job information from job/internship offers received via email. It is particularly useful for candidates, students, and university professionals who need to manage job/internship offers efficiently. The application extracts information such as email, telephone number, company name, required skills, field, job/internship position, and country from received emails and their attachments (images/PDFs). Additionally, it can handle multiple offers within the same PDF file.

## Features

- Extracts relevant job/internship information from emails and attachments.
- Processes PDFs and images to retrieve textual information.
- Supports multiple offers extraction from a single PDF.
- Displays extracted data in a web-based dashboard.
- Uses AI technologies and various Python libraries for data extraction.
- Stores extracted data in a MySQL database.
- Utilizes PHP for front-end data rendering and Python for backend scripting.

## Technologies Used

- **SpaCy**: For natural language processing to extract desired data.
- **PyPDF2**: To convert PDF content into strings for text processing.
- **Pytesseract**: For OCR (Optical Character Recognition) to convert images to readable text.
- **Simplegmail**: To fetch and process received emails.
- **MySQL Connector**: To save the extracted data into a MySQL database.
- **PHP**: To render SQL data on the frontend.
- **Python**: As a scripting language to execute the AI script when the website/dashboard is loaded.

## Installation Guide

### Prerequisites

Ensure you have Python and pip installed on your system.

### Install Required Libraries

Run the following pip commands to install the necessary libraries:

```bash
pip install spacy
pip install PyPDF2
pip install pytesseract
pip install simplegmail
pip install mysql-connector-python
```

### Setting Up the Server

1. Install XAMPP: Download and install XAMPP from here.
2. Place the Project: Once XAMPP is installed, place the project folder in the xampp/htdocs directory.
3. Start Apache and MySQL: Open the XAMPP control panel and start both Apache and MySQL.
4. Access the Website: Open your web browser and navigate to http://localhost/[project_name]/login.html.

## Usage
1. Fetch Emails: The application uses the Simplegmail library to fetch emails containing job/internship offers.
2. Process Attachments: It processes attachments (PDFs and images) to extract relevant information using PyPDF2 and Pytesseract.
3. Data Extraction: SpaCy is used to extract specific details like email addresses, phone numbers, company names, required skills, job positions, and locations.
4. Store Data: Extracted data is stored in a MySQL database using the MySQL Connector.
5. Display Data: The frontend, built with PHP, renders the data for easy viewing and management.

## Customization
You can adjust this application to meet your specific needs by modifying the AI extraction parameters, database schema, and frontend design.
