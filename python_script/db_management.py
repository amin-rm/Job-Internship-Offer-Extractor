import mysql.connector
from datetime import datetime


# Insert mail data into the mail table :
def mail_data_insertion(listOfData,gmailID):
    try:
        # Connect to the MySQL server; 
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projet_test'
        )

        cursor = conn.cursor()

        # Get the current date in the format 'YYYY-MM-DD'
        current_date = datetime.today().date()

        query = "INSERT INTO mail_data (email, region, offer_type, comp_name, req_skills, duration, dept_name, insertion_date, msg_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
        
        values = tuple(listOfData[0:7]) + (current_date,) + (gmailID,)

        cursor.execute(query, values)
        conn.commit()

        cursor.close()
        conn.close()

        return True

    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return False
    

# Insert Attachment data data into the attachment table :
def attch_data_insertion(listOfData,attchID):
    try:
        # Connect to the MySQL server; 
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projet_test'
        )

        cursor = conn.cursor()

        # Get the current date in the format 'YYYY-MM-DD'
        current_date = datetime.today().date()

        query = "INSERT INTO attch_data (attch_mail, attch_region, attch_offer_type, attch_comp_name, attch_req_skills,attch_duration, attch_dept_name, attch_type, attch_insertion_date, attch_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
        
        values = tuple(listOfData[0:8]) + (current_date,) + (attchID,)

        cursor.execute(query, values)
        conn.commit()

        cursor.close()
        conn.close()

        return True

    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return False

# delete all information from the all tables :
def clear_tables():
    try:
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projet_test'
        )

        cursor = conn.cursor()

        query = "DELETE FROM mail_data"
        query2 = "DELETE FROM attch_data"


        cursor.execute(query)
        cursor.execute(query2)


        conn.commit()

        cursor.close()
        conn.close()

        return True

    except mysql.connector.Error as error:
        print("Error clearing the table:", error)
        return False



# Check if the email is already in the database :
def mail_not_found(id_msg):
    try:
        # Connecter au serveur mySQL :
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projet_test'
        )

        cursor = conn.cursor()

        query = f"SELECT * FROM mail_data WHERE msg_id = %s"

        cursor.execute(query, (id_msg,))

        result = cursor.fetchone()

        if result is None:
            return True
        else:
            return False

        cursor.close()
        conn.close()

    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return False


# Check if the attachment is already in the database :
def attch_not_found(id_msg):
    try:
        # Connecter au serveur mySQL :
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projet_test'
        )

        cursor = conn.cursor()

        query = f"SELECT * FROM attch_data WHERE attch_id = %s"

        cursor.execute(query, (id_msg,))

        result = cursor.fetchone()

        if result is None:
            return True
        else:
            return False

        cursor.close()
        conn.close()

    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return False
    


# Get the most recent date from the mail_data table
def get_most_recent_date():
    try:
        # Connect to the MySQL server
        conn = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projet_test'
        )

        cursor = conn.cursor()

        query = "SELECT MAX(insertion_date) FROM mail_data"

        cursor.execute(query)

        result = cursor.fetchone()[0]

        if result is None:
            return "2023-01-01"
        else:
            return result.strftime('%Y-%m-%d')

    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return None

    finally:
        if conn.is_connected():
            cursor.close()
            conn.close()