#Tools for mail exrtactor :
from simplegmail import Gmail
from simplegmail.query import construct_query
#Tools for img extractor :
import pytesseract
from PIL import Image
import PyPDF2
import os


# Mail extractor :
def messages_recus(n):
    listOfMessages=[]
    info=''
    gmail = Gmail()
    # Unread messages in your inbox
    query_params = {
    "newer_than": (n, "day") # filter time !
    }
    messages = gmail.get_messages(query=construct_query(query_params))

    for message in messages:
        info=message.sender[message.sender.index("<")+1:message.sender.index(">")]+'. '+message.subject+'. '+message.plain+' ¶'+message.id
        listOfMessages.append(info) # put messages in a list
        # download attchements with a custom filename :
        if message.attachments:
            for index, attm in enumerate(message.attachments, start=1):
                custom_filename = f"{message.id}_{index}.{str(attm.filetype[str(attm.filetype).index('/')+1:])}"
                file_path = os.path.join(os.getcwd(), "attachments", custom_filename)
                attm.save(file_path, overwrite=True)
    return listOfMessages

# Image extractor :
def img_to_text():
    directory = "attachments"
    L=[]
    pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"
    # Iterate over the files in the "img" directory
    for filename in os.listdir(directory):
        if filename.endswith(".jpg") or filename.endswith(".png") or filename.endswith(".jpeg"):
            # Create the full path to the image file
            img_path = os.path.join(directory, filename)
            # Open the image file
            image = Image.open(img_path)
            # Use pytesseract to extract text from the image
            text = str(filename)[:str(filename).index(".")] + ". \n \n" + pytesseract.image_to_string(image)
            L.append(text)
    return L



# Image extractor :
def pdf_to_text():
    directory = "attachments"
    L=[]
    pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"
    # Iterate over the files in the "img" directory
    for filename in os.listdir(directory):
        if filename.endswith(".pdf"):
            # Create the full path to the image file
            pdf_path = os.path.join(directory, filename)

            pdf_reader = PyPDF2.PdfReader(pdf_path)

            num_pages = len(pdf_reader.pages)

            for page_num in range(num_pages):
                # Get the text from the current page
                page_text = pdf_reader.pages[page_num].extract_text()
                # Append the text to the list
                text = str(filename)[:str(filename).index(".")] + "_" + str(page_num) + ". \n" + page_text
                L.append(text)

    return L

