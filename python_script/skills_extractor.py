import spacy
from spacy.matcher import PhraseMatcher
import pandas as pd

def prepare_skills(df):
    # Combine multi-token skills into a single string
    df["lowercase_name"] = df["Skill"].str.lower()
    return df.set_index("lowercase_name")["Skill"].to_dict()


def extract_skills(paragraph):
    # Load the spaCy model
    nlp = spacy.load("en_core_web_sm")

    # Read the CSV file containing the skills
    df = pd.read_csv("skills_dataset.csv", usecols=["Skill"], encoding="utf-8")

    # Create a list of all the skills in the CSV file (original case)
    skills = prepare_skills(df)

    # Convert the paragraph to lowercase
    paragraph_lower = paragraph.lower()

    # Create a PhraseMatcher with the skills
    matcher = PhraseMatcher(nlp.vocab)
    patterns = [nlp.make_doc(skill) for skill in skills.keys()]
    matcher.add("Skills", None, *patterns)

    # Create a spaCy document from the paragraph
    doc = nlp(paragraph_lower)

    # Initialize a set to store the extracted skills (to avoid duplicates)
    extracted_skills = set()

    # Check for matches in the original version of the paragraph
    for match_id, start, end in matcher(doc):
        # Get the matched span
        matched_span = doc[start:end]

        # Get the matched name
        matched_name = matched_span.text

        # Check if the matched name is in the skills dictionary
        if matched_name in skills:
            extracted_skills.add(skills[matched_name])


    # Return "0" as a string if no skills are extracted, otherwise return the skills separated by a slash '/'
    if not extracted_skills:
        return "0"
    else:
        return "/".join(set(extracted_skills)).replace("\n","")


