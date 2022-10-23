import socket, ssl, argparse, re, os, html
from tempfile import TMP_MAX

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
    req = f"""GET /wp-admin/media-new.php HTTP/1.1\r\nHost: {url}\r\nCookie: {cookie}\r\n\r\n"""
    sock.send(req.encode())
    data = b""
    while 1:
        tmp = sock.recv(4096)
        if not tmp:
            break
        data += tmp
    data = data.decode()
    start = re.search('name="_wpnonce"', data).end() + 8
    end = start + 10
    wpnonce = data[start:end]
    return wpnonce

def send_image(url, local_file, cookie, wpnonce):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.connect((url,80))
    img = open(local_file, 'rb').read()
    file_name = local_file.split("/")[-1]
    extension = file_name.split(".")[-1]
    body =f'''------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="name"\r
\r
{file_name}\r  
------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="post_id"\r
\r
0\r
------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="_wpnonce"\r
\r
{wpnonce}\r
------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="type"\r
\r
\r
------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="tab"\r
\r
\r
------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="short"\r
\r
1\r
------WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Content-Disposition: form-data; name="async-upload"; filename="{file_name}"\r
Content-Type: image/{extension}\r
\r
{img}\r
------WebKitFormBoundaryXKO4AzI37YAFOk0n--\r
\r
'''
    length = len(body)
    req = f"""POST /wp-admin/async-upload.php HTTP/1,1\r
Host: {url}\r
Cookie: {cookie}\r
Content-Length: {length}\r
Content-Type: multipart/form-data;boundary=----WebKitFormBoundaryXKO4AzI37YAFOk0n\r
Connection: keep-alive\r
\r
"""
    req += body
    sock.send(req.encode())
    data = sock.recv(2048)
    data = data.decode()
    if "HTTP/1.1 200 OK" in data:
        print("Upload success")
    else:
        print("Failed")
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
#         print(cookie)
#         print("\n")
        wpnonce = get_wpnonce(url, cookie)
#         print(wpnonce)
#         print("\n")
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
