import re

def extract_emails(text):
    # Regular expression pattern to match email addresses
    email_pattern = r'\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,7}\b'

    # Find all email matches in the text
    email_matches = re.findall(email_pattern, text)

    # Use a set to remove duplicate email addresses
    unique_emails = set(email_matches)

    if not unique_emails:
        return "-"
    
    # Create a comma-separated string of unique emails
    result = ', '.join(unique_emails)

    return result
