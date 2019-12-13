#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X POST http://127.0.0.1/rsmev/inn/sendrequest?result >> output.xml -d '{
                                                                                  "legal_entity":{
                                                                                     "ogrn":"1037843048880",
                                                                                     "inn":"7825497650",
                                                                                     "name":"Нагрузочное тестирование"
                                                                                  },
                                                                                  "individual":{
                                                                                     "birthDay":"1954-07-12",
                                                                                     "birthPlace":"РОССИЯ,,ГОРЬКОВСКАЯ ОБЛ.,АРЗАМАССКИЙ Р-Н,,НИКОЛЬСКОЕ С., ,,,",
                                                                                     "firstName":"ПЕТР",
                                                                                     "lastName":"ЧАХЛОВ",
                                                                                     "secondName":"АЛЕКСЕЕВИЧ",
                                                                                     "document":{
                                                                                        "docCode":"21",
                                                                                        "number":"22 02 919928",
                                                                                        "date":"2002-11-16",
                                                                                        "issueName":"АРОВД"
                                                                                     }
                                                                                  }
                                                                               }
' ;