import socket, ssl, argparse, re, os, html

def get_url():
    args = argparse.ArgumentParser()
    args.add_argument('--url')
    args.add_argument('--user')
    args.add_argument('--password')
    args.add_argument('--local-file')
    return args.parse_args()

def get_cookie(data):
    cookies = []
    stringSplit = data.split("\r\n")
    for i in stringSplit:
        if "Set-Cookie: " in i:
            cookies.append(i.split(";")[0].split(":")[1].strip())
    return ";".join(cookies)

def get_wpnonce(url,cookie):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.connect((url, 80))
    req = f"""GET /wp-admin/media-new.php HTTP/1.1\r
Host: {url}\r
Cookie: {cookie}\r
\r
"""
    sock.send(req.encode())
    data=sock.recv(2048)
    wpnonce = re.findall(b'"post_id":0,"_wpnonce":"(.*)","type":"","tab":"","short":"1"',data)
    return wpnonce

def send_image(url, local_file, cookie, wpnonce):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.connect((url,80))
    img = open(local_file, 'rb').read()
    file_name = local_file.split("/")[-1]
    extension = file_name.split(".")[-1]
    body =f'''------WebKitFormBoundaryV9uLzxMjxVJ4E0bo\r
Content-Disposition: form-data; name="name"\r
\r
{file_name}\r  
------WebKitFormBoundaryV9uLzxMjxVJ4E0bo\r
Content-Disposition: form-data; name="post_id"\r
\r
0\r
------WebKitFormBoundaryV9uLzxMjxVJ4E0bo\r
Content-Disposition: form-data; name="_wpnonce"\r
\r
{wpnonce}\r
------WebKitFormBoundaryOxxPPpFHwaE0tGe1\r
Content-Disposition: form-data; name="type"\r
\r
\r
------WebKitFormBoundaryOxxPPpFHwaE0tGe1\r
Content-Disposition: form-data; name="tab"\r
\r
\r
------WebKitFormBoundaryOxxPPpFHwaE0tGe1\r
Content-Disposition: form-data; name="short"\r
\r
1\r
------WebKitFormBoundaryOxxPPpFHwaE0tGe1\r
Content-Disposition: form-data; name="async-upload"; filename="{file_name}"\r
Content-Type: image/{extension}\r
\r
{img}\r
------WebKitFormBoundaryOxxPPpFHwaE0tGe1--\r
\r'''
    length = len(body)
    req = f"""POST /wp-admin/async-upload.php HTTP/1.1\r
Host: {url}\r
Cookie: {cookie}\r
Content-Type: multipart/form-data\r
Content-Length: {length}\r
\r
"""
    req += body
    sock.send(req.encode())
    data = sock.recv(2048)
    data = data.decode()
    # if "HTTP/1.1 200 OK" in data and '{"success":true' in data:
    #     path=re.findall(b'<button type="button" class="button button-small copy-attachment-url" data-clipboard-text="(.*)">Copy URL to clipboard</button>',data)
    #     print(f"Upload success. File upload url: {path[0].decode()}")
    # else:
    #     print("Failed")
    print (data)

def login(url, user, password, local_file):
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
    data=data.decode()
    if "login_error" not in data:
        print("User {} dang nhap thanh cong\n".format(user))
        cookie = get_cookie(data)
        print(cookie)
        wpnonce = get_wpnonce(url, cookie)
        print(wpnonce)
        send_image(url, local_file, cookie, wpnonce)
    else:
        print("User {} dang nhap that bai".format(user))
    sock.close()

def main():
    args = get_url()
    url = args.url
    user = args.user
    password = args.password
    local_file = args.local_file
    login(url[7:-1], user, password, local_file)
    
if __name__ == '__main__':
    main()
