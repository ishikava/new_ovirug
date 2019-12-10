#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X POST http://127.0.0.1/rsmev/snils/sendrequest?envelope >> output.xml -d '{
                                                                                   "legal_entity":
                                                                                   {
                                                                                     "ogrn":"1047839009129",
                                                                                     "inn":"7840013199",
                                                                                     "name":"Жилищный комитет"
                                                                                   },
                                                                                   "individual":
                                                                                   {
                                                                                     "birthDay":"1964-01-04",
                                                                                     "gender":"Male",
                                                                                     "BirthPlace":
                                                                                     {
                                                                                       "PlaceType":"ОСОБОЕ",
                                                                                       "Settlement":"",
                                                                                       "District":"",
                                                                                       "Region":"Ленинград",
                                                                                       "Country":"Россия"
                                                                                     },
                                                                                     "firstName":"Виктор",
                                                                                     "lastName":"Апраксин",
                                                                                     "secondName":"Игоревич",
                                                                                     "document":
                                                                                     {
                                                                                       "series":"4015",
                                                                                       "number":"339667",
                                                                                       "date":"2015-08-28",
                                                                                       "issueName":"Тп N139 Оуфмс России По Спб И Ло В Центральном Р-Не Спб"
                                                                                     }
                                                                                   }
                                                                                 }' ;