#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/ZDDK_Service/processCanonicalService'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/zddk >> output.xml -d '<?xml version="1.0"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><soapenv:Header xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><wsse:BinarySecurityToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" Id="4c745f57-c50a-4611-a06f-e557d135600e" EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" u:Id="4c745f57-c50a-4611-a06f-e557d135600e">MIIBDDCBugIJAI6DxIvtX2AzMAoGBiqFAwICAwUAMA0xCzAJBgNVBAYTAnJ1MB4XDTE4MDcwMzE2MjY1N1oXDTE5MDcwMzE2MjY1N1owDTELMAkGA1UEBhMCcnUwYzAcBgYqhQMCAhMwEgYHKoUDAgIjAQYHKoUDAgIeAQNDAARAJ9icTf7T6BpH5u4vCLLQUWI5jqXmCRUaJvW0YozMcsqYzRocMZihI3RAkp2P8Yk58Kx7se9imYzl7SabW4e67jAKBgYqhQMCAgMFAANBAChd14fMYZDN/XHWtxNB6awzobXBWj0cVckw4HPh8KOmybAM68NfvEsCoqcY7a1yCQu9xJbQlrZ7h3B8NK4phmk=</wsse:BinarySecurityToken><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/><ds:Reference URI="#bId"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/><ds:DigestValue>5Zta/PWB5OatN5F7uz+CDNvSKK1/t8fu4wDZXg2knqA=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue>sQhI4Lug1cP47tcOgQ8H5hAZAwAzOmAcoQMoiQAyUO+wecev62InYDYhF9nDQjcnfd8nsNCYM1doRNJW3WPhWw==</ds:SignatureValue><ds:KeyInfo><wsse:SecurityTokenReference><wsse:Reference URI="#4c745f57-c50a-4611-a06f-e557d135600e" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3&quot;"/></wsse:SecurityTokenReference></ds:KeyInfo></ds:Signature></wsse:Security></soapenv:Header><s:Body u:Id="bId" Id="bId"><processCanonicalService xmlns="http://ec.minregion.ru/">
         <Message xmlns="http://smev.gosuslugi.ru/rev120315">
            <Sender>
               <Code>KIS001781</Code>
               <Name>КИС СПб</Name>
            </Sender>
            <Recipient>
               <Code>IAC</Code>
               <Name>ИАЦ</Name>
            </Recipient>
            <Originator>
               <Code>KIS001781</Code>
               <Name>КИС СПб</Name>
            </Originator>
            <TypeCode>GSRV</TypeCode>
            <Status>REQUEST</Status>
            <Date>2018-06-30T12:01:17.7617244+04:00</Date>
         </Message>
         <MessageData xmlns="http://smev.gosuslugi.ru/rev120315">
            <AppDocument>
               <RequestCode>req_ac340d3e-3da0-43bc-aac6-f45ab85cf553</RequestCode>
               <BinaryData>UEsDBBQAAAAIAEti8kyHvwWEBgEAADQCAAAsAAAAcmVxX2FjMzQwZDNlLTNkYTAtNDNiYy1hYWM2LWY0NWFiODVjZjU1My54bWyVkb9OwzAQh3ck3sHyHjuhDKhy0gnEAAvtwJq6RxJo7BI7JGyoPAEjQuLPxsAAQiyV+g6XN8IVUpsBhDLc3fR9v590YlDnU3IFhcm0CmnAfEpAST3JVBLS0p55e3QQbW+JVJcGxlpf7Ne2iKXNtDqByxKMJc6gTL82WUhTa2d9zquqYlWP6SLhO74f8NPjo6FMIY+9TBkbKwl0TU3+p6grQIjQ43OQdqQr9QOvwV+6sRyMiRMYXc/A0Ahf8B2XuGjmHj7hVzN3c4Mfza3bn4JvzO2koS0AbPesO3zEB3zDV3fvict7ZoK3le2Qw5Wvc8au4C287TuYxt0rBz3BN/jq3fzvf0ffUEsBAh8AFAAAAAgAS2LyTIe/BYQGAQAANAIAACwAJAAAAAAAAAAgAAAAAAAAAHJlcV9hYzM0MGQzZS0zZGEwLTQzYmMtYWFjNi1mNDVhYjg1Y2Y1NTMueG1sCgAgAAAAAAABABgAVVW6Rnge1AFLzbdGeB7UAV7TY6KFhs0BUEsFBgAAAAABAAEAfgAAAFABAAAAAA==</BinaryData>
            </AppDocument>
         </MessageData>
      </processCanonicalService></s:Body></s:Envelope>' ;