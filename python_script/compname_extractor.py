import spacy
from spacy.matcher import PhraseMatcher
import pandas as pd

def prepare_company_names(df):
    # Combine multi-token names into a single string
    df["lowercase_name"] = df["Name"].str.lower()
    return df.set_index("lowercase_name")["Name"].to_dict()

def extract_company_names(paragraph):
    # Load the spaCy model with the NER component
    nlp = spacy.load("en_core_web_sm")

    # Read the CSV file containing the company names dataset with the correct encoding
    df = pd.read_csv("startup_dataset.csv", usecols=["Name"], encoding="utf-8")

    # Prepare the company names for case-sensitive matching
    company_names = prepare_company_names(df)

    # Convert the paragraph to lowercase
    paragraph_lower = paragraph.lower()

    # Create a PhraseMatcher with the custom company names
    matcher = PhraseMatcher(nlp.vocab)
    patterns = [nlp.make_doc(name) for name in company_names.keys()]
    matcher.add("CompanyNames", None, *patterns)

    # Create a spaCy document from the paragraph
    doc = nlp(paragraph_lower)

    # Initialize a set to store the extracted company names (to avoid duplicates)
    extracted_company_names = set()

    # Check for matches in the original version of the paragraph
    for match_id, start, end in matcher(doc):
        # Get the matched span
        matched_span = doc[start:end]

        # Get the matched name
        matched_name = matched_span.text

        # Check if the matched name is in the company_names dictionary
        if matched_name in company_names:
            extracted_company_names.add(company_names[matched_name])


    # Return "0" as a string if no company names are extracted, otherwise return the company names separated by a slash '/'
    if not extracted_company_names:
        return extract_company_names_spacy(str(paragraph_lower).title())
    else:
        return "/".join(extracted_company_names)
    

# extract company names from spacy (if there is no existing data in the custom csv file) :
def extract_company_names_spacy(paragraph):
    # Load the spaCy model with the NER component
    nlp = spacy.load("en_core_web_sm")

    # Create a spaCy document from the paragraph
    doc = nlp(paragraph)

    # Initialize a set to store the extracted company names (to avoid duplicates)
    extracted_company_names = set()

    # Iterate through the named entities recognized by spaCy
    for entity in doc.ents:
        # Check if the recognized entity is an organization/company
        if entity.label_ == "ORG":
            extracted_company_names.add(entity.text)

    if not extracted_company_names:
        return paragraph[:str(paragraph).index("@")] # if the company name is not in the dataset and is also not recognized by spacy. the sender info will be assigned to the comp name.
    else:
        return "/".join(extracted_company_names)
