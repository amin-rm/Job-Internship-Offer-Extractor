import re

def clean_text(text):
    # Remove excessive spaces between words:
    cleaned_text = re.sub(r'\s+', ' ', text)

    # Remove big spaces between lines:
    cleaned_text = re.sub(r'\n\s*\n', '\n\n', cleaned_text)

    return cleaned_text