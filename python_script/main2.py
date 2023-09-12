from simplegmail import Gmail
import os
gmail = Gmail()

messages=gmail.get_messages()

message = messages[0]

print(message.plain) # teeeest 1

if message.attachments:
    for index, attm in enumerate(message.attachments, start=1):
        custom_filename = f"{message.id}_{index}.{str(attm.filetype[str(attm.filetype).index('/')+1:])}"
        file_path = os.path.join(os.getcwd(), "attachments", custom_filename)
        print('File: ' + attm.filename)
        attm.save(file_path)