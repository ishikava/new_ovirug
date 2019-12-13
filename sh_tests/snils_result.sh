#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X GET http://127.0.0.1/rsmev/snils/getresult?result >> output.xml -d '' ;