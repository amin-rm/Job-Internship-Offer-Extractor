# Import the extractors and their libraries :
from mail_extractor import *
from compname_extractor import *
from duration_extractor import *
from offer_type_extractor import *
from skills_extractor import *
from dept_name import *
from text_extractor import *
from text_cleaner import *
from db_management import *
from datetime import datetime

print("geloooooo")

# Calculer la différence (en jours) entre la date actuelle et la date de la dernière insertion :
current_date = datetime.today().date() # Date actuel sous forme d'objet 'DATE'

current_datetime = datetime.strptime(current_date.strftime('%Y-%m-%d'), '%Y-%m-%d') # Date actuel
latest_insertion_datetime = datetime.strptime(get_most_recent_date(), '%Y-%m-%d') # Date de la dernière insertion

date_difference = (current_datetime - latest_insertion_datetime).days # Différence en jours



# INSERTION DES DONNEES EXTRAITES PAR MAIL :
messages=messages_recus(date_difference+1) # extraire une liste des messages qui ne sont pas disponibles dans la table sql (par la difference des dates)
relevantInformation = [] # Préparer une liste pour les données pertinentes pour chaque message
for message in messages:
    if mail_not_found(str(message)[str(message).index("¶")+1:]): # verifier si l'id de mail existe deja dans le tableau
        if extract_offer_type(clean_text(message)) is not None:
            relevantInformation.append(extract_emails(message))
            relevantInformation.append("Tunisia")
            relevantInformation.append(extract_offer_type(message))
            relevantInformation.append(extract_company_names(message))
            relevantInformation.append(extract_skills(message))
            relevantInformation.append(extract_internship_duration(message))
            relevantInformation.append(extract_dept_name(message))
            mail_data_insertion(relevantInformation, str(message)[str(message).index("¶")+1:])
            print("Insertion avec succeeeeeeees !!!!!!")
            relevantInformation=[]
        else:
            print("La lettre ne corréspond pas à une offre !")
    else:
        print("Mail existe dejaaa !")



# INSERTION DES DONNEES EXTRAITES PAR IMAGE :

images=img_to_text()

for image in images:
    if attch_not_found(str(image)[:str(image).index(".")]): # verifier si l'id de l'image existe deja dans le tableau
        if extract_offer_type(clean_text(image)) is not None:
            relevantInformation.append(extract_emails(image))
            relevantInformation.append("Tunisia")
            relevantInformation.append(extract_offer_type(image))
            relevantInformation.append(extract_company_names(image))
            relevantInformation.append(extract_skills(image))
            relevantInformation.append(extract_internship_duration(image))
            relevantInformation.append(extract_dept_name(image))
            relevantInformation.append("Image")
            attch_data_insertion(relevantInformation, str(image)[:str(image).index(".")])
            print("Insertion avec succeeeeeeees !!!!!!")
            relevantInformation=[]
        else:
            print("L'image ne corréspond pas à une offre !")
    else:
        print("Image existe dejaaa dans le tableau !")


# INSERTION DES DONNEES EXTRAITES PAR PDF :

pdfs=pdf_to_text()

for pdf in pdfs:
    if attch_not_found(str(pdf)[:str(pdf).index(".")]): # verifier si l'id de l'image existe deja dans le tableau
        if extract_offer_type(clean_text(pdf)) is not None:
            relevantInformation.append(extract_emails(pdf))
            relevantInformation.append("Tunisia")
            relevantInformation.append(extract_offer_type(pdf))
            relevantInformation.append(extract_company_names(pdf))
            relevantInformation.append(extract_skills(pdf))
            relevantInformation.append(extract_internship_duration(pdf))
            relevantInformation.append(extract_dept_name(pdf))
            relevantInformation.append("PDF")
            attch_data_insertion(relevantInformation, str(pdf)[:str(pdf).index(".")])
            print("Insertion avec succeeeeeeees !!!!!!")
            relevantInformation=[]
        else:
            print("Le PDF ne corréspond pas à une offre !")
    else:
        print("PDF existe dejaaa dans le tableau !")