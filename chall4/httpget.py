import socket, ssl, argparse, re, os, html

def get_url():
    # add_argument định nghĩa cách mà các biến từ CLI sẽ được truyền vào Python.
    args = argparse.ArgumentParser()
    args.add_argument('--url')
    return(args.parse_args())
    
def connect(url):
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.connect((url, 80))
    req = '''GET / HTTP/1.1\nHost:{}\n\n'''.format(url)
    sock.send(req.encode())
    data = sock.recv(1024)
    title = data.decode()
    title = re.findall('<title>(.*)</title>',title)
    print(f"{html.unescape(title[0])}")
    sock.close()

def main():
    args = get_url()
    url = args.url
    connect(url[7:-1])
    
if __name__ == '__main__':
    main()
