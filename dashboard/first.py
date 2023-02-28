import pyqrcode;
#pip install pyqrcode
import png;
#pip install pypng
from pyqrcode import QRCode;

s = "wwww.inprogrammer.com"

url = pyqrcode.create(s)

url.png('myqr.png', scale = 6)