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
