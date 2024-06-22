from http.server import BaseHTTPRequestHandler
from socketserver import TCPServer

class MyRequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/test':
            self.send_response(200)
            self.send_header('Content-type', 'text/plain')
            self.end_headers()
            self.wfile.write(b'This is a test API endpoint')
        else:
            super().do_GET()

# Define the server's address and port
server_address = ('', 7000)

# Create and start the server with the custom request handler
with TCPServer(server_address, MyRequestHandler) as httpd:
    print('Server started at port 7000...')
    httpd.serve_forever()
