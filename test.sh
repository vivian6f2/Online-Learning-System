#!/bin/bash
libreoffice --headless --convert-to pdf /var/www/html/HCI_project/PPT/CaoBei.pptx
unoconv -f pdf /var/www/html/HCI_project/PPT/CaoBei.pptx
