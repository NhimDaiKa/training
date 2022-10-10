import socket, ssl, argparse, re, os, html

def get_url():
    args = argparse.ArgumentParser()
    args.add_argument('--url')
    args.add_argument('--user')
    args.add_argument('--password')
    return args.parse_args()

def connect(url, user, password):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.connect((url, 80))
    body = "log={0}&pwd={1}".format(user,password)
    length = len(body)
    req = '''POST /wp-login.php HTTP/1.1\r
Host: {}\r
Content-Length: {}\r
Content-Type: application/x-www-form-urlencoded\r
\r
log={}&pwd={}'''.format(url, length, user, password)
    sock.send(req.encode())
    data=sock.recv(2048)
    data = data.decode()
    if "login_error" not in data:
        print("User {} dang nhap thanh cong".format(user))
    else:
        print("User {} dang nhap that bai".format(user))
    sock.close()

def main():
    args = get_url()
    url = args.url
    user = args.user
    password = args.password
    connect(url[7:-1], user, password)
    
if __name__ == '__main__':
    main()
