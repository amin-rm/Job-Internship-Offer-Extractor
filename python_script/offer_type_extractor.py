import unicodedata

# remove accents from a string
def remove_accents(text):
  """Removes all accents from a string."""
  text = unicodedata.normalize("NFD", text)
  text = "".join(c for c in text if not unicodedata.combining(c))
  text = unicodedata.normalize("NFC", text)
  return text

def extract_offer_type(text):
    # Convert the input text to lowercase and remove accents
    cleaned_text = remove_accents(text.lower())

    # List of offer types keywords
    L1 = ["pfe", "fin d'etude", "pfa"]
    L2 = ["job", "offre d'emploi", "job offer"]
    L3 = ["stage d'ete","stage", "summer internship","stagiaires","stagiaire","summer intern"]

    # Search for keywords from L1 :
    for keyword in L1:
        if keyword in cleaned_text:
            return "Stage PFE"  # Replace with the desired output for L1

    # Search for keywords from L2 :
    for keyword in L2:
        if keyword in cleaned_text:
            return "Offre d'emploi"  # Replace with the desired output for L2

    # Search for keywords from L3 :
    for keyword in L3:
        if keyword in cleaned_text:
            return "Stage d'été"  # Replace with the desired output for L2

    # If no offer type is found, return None or any other default value as needed
    return None