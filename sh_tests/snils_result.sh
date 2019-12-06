#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl http://127.0.0.1/rsmev/snils/getresult >> output.xml -d '' ;