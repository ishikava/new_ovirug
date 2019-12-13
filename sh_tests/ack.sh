#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X POST http://127.0.0.1/rsmev/sendackrequest?envelope >> output.xml -d '{
                                                                                  "messageId":"36db49ea-9585-11e8-8c3f-fa163e24a722"
                                                                              }' ;