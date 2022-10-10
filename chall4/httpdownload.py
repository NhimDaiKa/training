import argparse
import socket
def get_url():
    parser=argparse.ArgumentParser()
    parser.add_argument('--url')
    parser.add_argument('--remote-file')
    return parser.parse_args()

def down(url,remote_file):
    sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
    sock.connect((url,80))
    url="""GET /{} HTTP/1.1\r\nHost: {}\r\nConnection: close\r\n\r\n""".format(remote_file, url)
    sock.sendall(url.encode())
    data=b''
    while 1:
        tmp=sock.recv(2048)
        if not tmp:
            break
        data+=tmp
    if b"Content-Type: image/" not in data:
        print("Khong ton tai file anh")
        exit(0)
    else:
        data=data.split(b"\r\n\r\n")[1]
        print("Kich Thuoc File Anh: "+str(len(data.decode('iso-8859-1')))+" bytes")
        name_image=remote_file.split("/")[-1]
        f=open(name_image,"wb")
        f.write(data)
        sock.close()
        
def main():
    args = get_url()
    url = args.url
    remote_file = args.remote_file
    down(url[7:-1], remote_file)

if __name__ == '__main__':
    main()
