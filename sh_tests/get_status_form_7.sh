#!/bin/bash
echo '' > output.xml;
echo -e '============================ GetForm9Async ============================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/F7ASyncService/GetStatus'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/form_7async >> output.xml -d '<?xml version="1.0" encoding="UTF-8"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><s:Header><wsse:Security s:actor="http://smev.gosuslugi.ru/actors/smev" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><wsse:BinarySecurityToken EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" wsu:Id="CertId-29E085E338A3E9FCC5143651950258439718" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">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</wsse:BinarySecurityToken><ds:Signature Id="Signature-26430" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
<ds:SignedInfo>
<ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
<ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/>
<ds:Reference URI="#body">
<ds:Transforms>
<ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
</ds:Transforms>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/>
<ds:DigestValue>0QtvfUzr3vXI9leLa95YJ4hv79zKtiIwXHKEBl68q74=</ds:DigestValue>
</ds:Reference>
</ds:SignedInfo>
<ds:SignatureValue>
yJtR/h8RVuePYWQJ3Jr8RTIFINRX3LTjqypxtjIDSwMGGi5wcj+z7Bp5QAUAN2VwFA5suA54JKHY
pw/MotzSFg==
</ds:SignatureValue>
<ds:KeyInfo Id="KeyId-29E085E338A3E9FCC5143651950258439719">
<wsse:SecurityTokenReference wsu:Id="STRId-29E085E338A3E9FCC5143651950258439720" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><wsse:Reference URI="#CertId-29E085E338A3E9FCC5143651950258439718" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"/></wsse:SecurityTokenReference>
</ds:KeyInfo>
</ds:Signature></wsse:Security></s:Header><s:Body wsu:Id="body"><GetStatus xmlns="http://tempuri.org/">
         <id>497</id>
      </GetStatus></s:Body></s:Envelope>
' ;