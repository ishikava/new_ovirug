#!/bin/bash
echo '' > output.xml;
echo -e '============================ GetForm9Async ============================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/ReferenceInfoService/getReferenceInfo'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/check_reference >> output.xml -d '<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:chec="http://ovirug.dev/checkreference">
<soapenv:Header xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><wsse:BinarySecurityToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" Id="4c745f57-c50a-4611-a06f-e557d135600e" EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" wsu:Id="4c745f57-c50a-4611-a06f-e557d135600e">MIIBDDCBugIJAI6DxIvtX2AzMAoGBiqFAwICAwUAMA0xCzAJBgNVBAYTAnJ1MB4XDTE4MDcwMzE2MjY1N1oXDTE5MDcwMzE2MjY1N1owDTELMAkGA1UEBhMCcnUwYzAcBgYqhQMCAhMwEgYHKoUDAgIjAQYHKoUDAgIeAQNDAARAJ9icTf7T6BpH5u4vCLLQUWI5jqXmCRUaJvW0YozMcsqYzRocMZihI3RAkp2P8Yk58Kx7se9imYzl7SabW4e67jAKBgYqhQMCAgMFAANBAChd14fMYZDN/XHWtxNB6awzobXBWj0cVckw4HPh8KOmybAM68NfvEsCoqcY7a1yCQu9xJbQlrZ7h3B8NK4phmk=</wsse:BinarySecurityToken><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/><ds:Reference URI="#bId"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/><ds:DigestValue>PbOCegqYUxgF5TnxsBqNXJVTriQ5q/5Q2vZXDalDi0k=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue>DqrUDgkNDyAoJBNmjZnBFvcbOEF2y5AcCjZb5T80vW4mmzZ28nsI+Ps7n6jFi28w9Bix913o+wpAhSDLrRYRyg==</ds:SignatureValue><ds:KeyInfo><wsse:SecurityTokenReference><wsse:Reference URI="#4c745f57-c50a-4611-a06f-e557d135600e" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3&quot;"/></wsse:SecurityTokenReference></ds:KeyInfo></ds:Signature></wsse:Security></soapenv:Header><soapenv:Body xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:chec="http://ovirug.dev/checkreference" Id="bId">
      <rev:getReferenceInfo>
         <rev:Message>
            <rev:Sender>
               <rev:Code>KIS001781</rev:Code>
               <rev:Name>КИС СПб</rev:Name>
            </rev:Sender>
            <rev:Recipient>
               <rev:Code>IAC</rev:Code>
               <rev:Name>ИАЦ</rev:Name>
            </rev:Recipient>
            <rev:Originator>
               <rev:Code>KIS001781</rev:Code>
               <rev:Name>КИС СПб</rev:Name>
            </rev:Originator>
            <rev:TypeCode>2</rev:TypeCode>
            <rev:Status>REQUEST</rev:Status>
            <rev:Date>2018-03-07T10:30:00.452+04:00</rev:Date>
         </rev:Message>
         <rev:MessageData>
            <rev:AppData>
               <chec:Request>
                  <chec:formNumber>00201</chec:formNumber>
               </chec:Request>
            </rev:AppData>
         </rev:MessageData>
      </rev:getReferenceInfo>
   </soapenv:Body>
</soapenv:Envelope>
' ;