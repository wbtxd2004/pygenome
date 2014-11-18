#!/opt/local/bin/python
#Filename:db_to_gb_sys.py

from BioSQL import BioSeqDatabase
from Bio import SeqIO
import sys
#path = '/home/wubin/tmp/'
#print path
#print sys.argv[1]
date=sys.argv[1]
path=sys.argv[2]
target=sys.argv[3]

def main(date,path,target):
	driver = "MySQLdb"
	user   = "wubin"
	passwd = "wubin"
	host   = "localhost"
	#db     = "pytest"

	output = path+date+'.gb'
	print output
	handle = open(output,"w")
	server = BioSeqDatabase.open_database(driver=driver, user=user, passwd=passwd, host=host, db="pytest")
	db = server["pygenome_db"]
	#target="agt830.5"
	#record = db.lookup(name  = target)
	record = db.lookup(name  = target)
	SeqIO.write(record, handle, "genbank")
	handle.close
	#print record

if __name__ == "__main__":
	if len(sys.argv) != 4:
		print __doc__
		sys.exit()
	main(sys.argv[1],sys.argv[2],sys.argv[3])
