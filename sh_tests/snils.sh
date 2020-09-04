#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X POST http://127.0.0.1/rsmev/snils/sendrequest?result >> output.xml -d '{
                                                                                   "legal_entity":
                                                                                   {
                                                                                     "ogrn":"1047839009129",
                                                                                     "inn":"7840013199",
                                                                                     "name":"Жилищный комитет"
                                                                                   },
                                                                                   "individual":
                                                                                   {
                                                                                     "birthDay":"2001-05-19",
                                                                                     "gender":"Male",
                                                                                     "BirthPlace":
                                                                                     {
                                                                                       "PlaceType":"СТАНДАРТНОЕ",
                                                                                       "Settlement":"Санкт-Петербург",
                                                                                       "District":"Санкт-Петербург",
                                                                                       "Region":"Санкт-Петербург",
                                                                                       "Country":"Россия"
                                                                                     },
                                                                                     "firstName":"Иван",
                                                                                     "lastName":"Апраксин",
                                                                                     "secondName":"Викторович",
                                                                                     "document":
                                                                                     {
                                                                                       "type":"BirthCertificate",
                                                                                       "series":"I-АК",
                                                                                       "number":"607231",
                                                                                       "date":"2001-09-13",
                                                                                       "issueName":"О/ЗАГС Выборгск.р-на Комитета по делам ЗАГС Правит.СПБ"
                                                                                     }
                                                                                   }
                                                                                 }' ;