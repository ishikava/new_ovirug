#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -X POST http://127.0.0.1/rsmev/snils/sendrequest >> output.xml -d '{
  "FamilyName": "ИВАНОВ",
  "FirstName": "ИВАН",
  "Patronymic": "ИВАНОВИЧ",
  "BirthDate": "1967-05-21",
  "Gender": "Male",
  "BirthPlace": {
    "PlaceType": "ОСОБОЕ",
    "Settlement": "ЗАГОРСК",
    "District": "ЛЕНИНСКИЙ",
    "Region": "МОСКОВСКАЯ ОБЛАСТЬ",
    "Country": "РФ"
  },
  "PassportRF": {
    "Series": "0005",
    "Number": "777777",
    "IssueDate": "1986-06-13",
    "Issuer": "ОВД"
  }
}' ;