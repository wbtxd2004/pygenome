#!/opt/local/bin/python
#Filename:db_to_gb_sys.py

from BioSQL import BioSeqDatabase
from Bio import SeqIO
import sys
#path = '/home/wubin/tmp/'
#print path
#print sys.argv[1]
name=sys.argv[1]
path=sys.argv[2]
target=sys.argv[3]
output = path+name+'.gb'
print output
handle = open(output,"w")
server = BioSeqDatabase.open_database(driver = "MySQLdb", user = "root",passwd = "wubin", host = "localhost", db = "wbtest")
db = server["pytestdb"]
#target="agt830.5"
#record = db.lookup(name  = target)
record = db.lookup(name  = target)
SeqIO.write(record, handle, "genbank")
handle.close
#print record
