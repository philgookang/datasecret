import time

class Spider:
    
    def __init__(self):
        self.parser_list = []

    def addParser(parser):
        self.parser_list.append(parser)

    def run(self):
        while True:
            # loop through parser list 
            # each parser will internally check its polling status and search
            for parser in self.parser_list:
                parser.run()
            
            # sleep for 1 second
            time.sleep(1)
