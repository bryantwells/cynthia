import os
import json
from flask import Flask, request, jsonify, abort
from nacl.signing import VerifyKey
from nacl.exceptions import BadSignatureError

PUBLIC_KEY = os.environ['PUBLIC_KEY']
verify_key = VerifyKey(bytes.fromhex(PUBLIC_KEY))


app = Flask(__name__)

@app.route('/', methods = ['GET', 'POST', 'DELETE'])
def spin():
	match request.method:

		# GET request
		case 'GET':

			# respond with current data
			f = open('data/data.json')
			data = json.load(f)
			return jsonify(data)
		
		# DELETE request
		case 'DELETE':

			# request info
			id = request.args.get('id')

			# handle valid request
			try:

				# open JSON file and append data
				f = open('data/data.json')
				data = [] if (os.stat('data/data.json').st_size == 0) else json.load(f)
				data = [d for d in data if not (d['id'] == id)]
				with open('data/data.json', 'w') as f:
					json.dump(data, f)
				f.close()
				return jsonify(data)

			# handle invalid request
			except:
				abort(400, 'bad request')


		
		# POST request
		case 'POST':

			# request info
			signature = request.headers["X-Signature-Ed25519"]
			timestamp = request.headers["X-Signature-Timestamp"]
			body = request.data.decode("utf-8")
			request_data = request.get_json()

			# handle valid request
			try:

				# validate security headers
				verify_key.verify(f'{timestamp}{body}'.encode(), bytes.fromhex(signature))

				# test json contents
				match request_data:

					# PING request
					case { 'type' : 1 }:
						return jsonify({ 'type' : 1 })
					
					# Interaction Request
					case _:

						# open JSON file and append data
						f = open('data/data.json')
						data = [] if (os.stat('data/data.json').st_size == 0) else json.load(f)
						data.append(request_data)
						with open('data/data.json', 'w') as f:
							json.dump(data, f)
						f.close()

						# respond
						return jsonify({ 
							'type' : 4,
							'data': {
								'content': 'Message succesfully sent to the web 🕸️',
							}
						})
					
			# handle invalid request
			except BadSignatureError:
				abort(401, 'invalid request signature')


if __name__ == '__main__':
	app.run()