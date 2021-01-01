from flask import Flask, jsonify, abort, make_response, request
import pymysql
import configparser
from pymysql.constants import CLIENT
config = configparser.RawConfigParser()


# Database Connection
connection = pymysql.connect(host="localhost", user="root", passwd="mysqlpassword", database="api", client_flag=CLIENT.MULTI_STATEMENTS)
# Can use DB for queries
db = connection.cursor()

app = Flask(__name__)


@app.route('/get/all', methods=['GET'])
def get_users():
    # Handle Parsing and SQL here
    retrive = "Select * from users;"
    db.execute(retrive)
    rows = db.fetchall()
    for row in rows:
        print(row)
    return jsonify({'users': rows})


@app.route('/get/single', methods=['POST'])
def get_user():
    id = request.json.get('id')
    retrieve = "Select firstName, lastName, email from users where id = " + id + ";"
    # retrieve = "SHOW TABLES;"
    db.execute(retrieve)
    rows = db.fetchall()
    for row in rows:
        print(row)

    return jsonify({'users': rows})


@app.route('/create/user', methods=['POST'])
def create_user():
    firstname = request.json.get('firstName')
    lastname = request.json.get('lastName')
    email = request.json.get('email')
    if firstname is None or lastname is None:
        abort(400)  # Missing arguments from JSON

    # Function that checks if email already exist in the DB
    retrieve = "Select id from users where email ='" + email + "';"
    db.execute(retrieve)
    rows = db.fetchone()
    if rows is not None:
        abort(403)

    insert = "INSERT INTO users(firstName, lastName, email) VALUES ('" + firstname + "', '" + lastname + "', '" + email + "');"

    db.execute(insert)
    connection.commit()

    return jsonify({'firstName': firstname, 'lastName': lastname, 'Created': True}), 201


@app.route('/delete/user', methods=['POST'])
def delete_user():
    id = request.json.get('id')
    retrieve = "Delete from users where id = " + id + ";"
    db.execute(retrieve)
    connection.commit()

    # Handle Parsing and SQL here
    return jsonify({'id': id, 'Deleted': True}), 201


@app.errorhandler(404)
def not_found(error):
    return make_response(jsonify({'error': 'Not found'}), 404)


@app.errorhandler(403)
def already_exists(error):
    return make_response(jsonify({'error': 'User Already Exists'}), 403)


if __name__ == '__main__':
    app.run(debug=True)
