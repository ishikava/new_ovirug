#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X POST http://127.0.0.1/esun/pre_registration >> output.xml -d '' ;