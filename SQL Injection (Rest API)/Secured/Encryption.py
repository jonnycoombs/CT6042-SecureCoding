from cryptography.fernet import Fernet
key = b'wn4k6OcMOV59SMec89iJQQyLeu0pGIDp0bzCPohDkjg='
cipher_suite = Fernet(key)
ciphered_text = cipher_suite.encrypt(b"restPassword")
print(ciphered_text)
uncipher_text = (cipher_suite.decrypt(ciphered_text))
print(uncipher_text)