import unicodedata

# remove accents from a string
def remove_accents2(text):
  """Removes all accents from a string."""
  text = unicodedata.normalize("NFD", text)
  text = "".join(c for c in text if not unicodedata.combining(c))
  text = unicodedata.normalize("NFC", text)
  return text

def extract_dept_name(text):
    # Convert the input text to lowercase and remove accents
    cleaned_text = remove_accents2(text.lower())

    # List of department keywords keywords
    L1 = ["informatique", "programmation", "computer science", "programming","systèmes d’information","information technology","data science","data scientist","ai"]
    L2 = ["electromecanique", "mecatronique","electromechanics", "mechatronics", "mecanique", "mechanical","mechanic"]
    L3 = ["genie civil","civil engineer","civil engineering"]

    

    # Search for keywords from L2 :
    for keyword in L2:
        if keyword in cleaned_text:
            return "Electromécanique"  # Replace with the desired output for L2

    # Search for keywords from L3 :
    for keyword in L3:
        if keyword in cleaned_text:
            return "Génie civil"  # Replace with the desired output for L3
        
    # Search for keywords from L1 :
    for keyword in L1:
        if keyword in cleaned_text:
            return "IT"  # Replace with the desired output for L1

    # If no department is found, return None or any other default value as needed
    return "-"