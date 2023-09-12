import spacy
import re
import time

start_time = time.time()

def extract_internship_duration(text):
    """Extracts the internship durat
    ion from a given text."""

    # Search for keywords such as "n months," "one month," "two months," etc.
    match = re.search(r"\b(a\s*)?((\d+)|(one|two|three|four|five|six|seven|eight|nine|ten))\s*(-\s*\w+)?\s+month?\b", text, re.IGNORECASE)
    if match:
        duration_word = match.group(2).lower()
        if duration_word.isdigit():
            return duration_word + " months"
        else:
            word_to_number = {
                "one": 1, "two": 2, "three": 3, "four": 4, "five": 5,
                "six": 6, "seven": 7, "eight": 8, "nine": 9, "ten": 10
            }
            return str(word_to_number[duration_word]) + " months"
    
    # Search for keywords such as "n months," "un mois," "deux mois," etc. in French.
    match = re.search(r"\b(un?|deux|trois|quatre|cinq|six|sept|huit|neuf|dix|\d+)\s+mois\b", text, re.IGNORECASE)
    if match:
        duration_word = match.group(1).lower()
        if duration_word.isdigit():
            return duration_word + " mois"
        else:
            word_to_number = {
                "une": 1, "un": 1, "deux": 2, "trois": 3, "quatre": 4, "cinq": 5,
                "six": 6, "sept": 7, "huit": 8, "neuf": 9, "dix": 10
            }
            return str(word_to_number[duration_word]) +" mois"

    # If no duration was found, return None.
    return "-"

