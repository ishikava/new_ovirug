#!/bin/bash
echo '' > output.xml;
echo -e '============================ GetForm9Async ============================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/ZDDK_Service/processCanonicalService'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/zddk >> output.xml -d '<?xml version="1.0" encoding="UTF-8"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><s:Header><wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" s:actor="http://smev.gosuslugi.ru/actors/smev"><wsse:BinarySecurityToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" wsu:Id="CertId-ADF131469F961D262F13637856157691543" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">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</wsse:BinarySecurityToken><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-586">
<ds:SignedInfo>
<ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
<ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/>
<ds:Reference URI="#_2">
<ds:Transforms>
<ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
</ds:Transforms>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/>
<ds:DigestValue>6QQTt42Tks3vlOBq/el9J/6RxcnKdEu/zGWNstzTsVQ=</ds:DigestValue>
</ds:Reference>
</ds:SignedInfo>
<ds:SignatureValue>
BT6GD6+h0MCjWI2T0Fu3GZNK0eon0WSv1vvRFkst3JoyXgGJPWPDk7hHQvNAWkeut/TETLX06+c4
QHXt5bP9Zg==
</ds:SignatureValue>
<ds:KeyInfo Id="KeyId-ADF131469F961D262F13637856157691544">
<wsse:SecurityTokenReference xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="STRId-ADF131469F961D262F13637856157691545" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><wsse:Reference URI="#CertId-ADF131469F961D262F13637856157691543" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"/></wsse:SecurityTokenReference>
</ds:KeyInfo>
</ds:Signature></wsse:Security></s:Header><s:Body u:Id="_2"><processCanonicalService xmlns="http://ec.minregion.ru/">
         <Message xmlns="http://smev.gosuslugi.ru/rev120315">
            <Sender>
               <Code>KIS001781</Code>
               <Name>КИС СПб</Name>
            </Sender>
            <Recipient>
               <Code>VCKP</Code>
               <Name>ВЦКП</Name>
            </Recipient>
            <Originator>
               <Code>KIS001781</Code>
               <Name>КИС СПб</Name>
            </Originator>
            <TypeCode>GSRV</TypeCode>
            <Status>REQUEST</Status>
            <Date>2012-08-30T12:01:17.7617244+04:00</Date>
         </Message>
         <MessageData xmlns="http://smev.gosuslugi.ru/rev120315">
            <AppDocument>
               <RequestCode>req_ac340d3e-3da0-43bc-aac6-f45ab85cf553</RequestCode>
               <BinaryData>UEsDBBQAAAAIAChgHkHhIMamBAEAADICAAAsACQAcmVxX2FjMzQwZDNlLTNkYTAtNDNiYy1hYWM2LWY0NWFiODVjZjU1My54bWwKACAAAAAAAAEAGABe02OihYbNAV7TY6KFhs0BXtNjooWGzQGVkTFOwzAUQHck7mB5b5yGBaoknUAMsNAOrG76SQKNXWIHh1tUIECioqLiAByAoVf4N+kVcCgpGSqhDH/7770v/fXXyu+X2YTcQa5SKQLadVxKQERynIo4oIW+6hzSfri/5yeyUDCS8ua41DmPtF2/gNsClCbWIFSvVGlAE62nPcaMMY45cGQeM891u+zy/GwQJZDxTiqU5iICuqXG/1PUHkCIL0fXEOmhNGIDb8EdtzkZKMVjGN5PQdEQX/AJ53becIGPdt5xia8++1M2EwOdA+j2kQU+WPEMn21mhp8EP3Du1JGNtJk5rYytK95Rbfzhm8KTCW9/tVfrKrr69C7m99XhN1BLAQItABQAAAAIAChgHkHhIMamBAEAADICAAAsACQAAAAAAAAAAAAAAAAAAAByZXFfYWMzNDBkM2UtM2RhMC00M2JjLWFhYzYtZjQ1YWI4NWNmNTUzLnhtbAoAIAAAAAAAAQAYAF7TY6KFhs0BXtNjooWGzQFe02OihYbNAVBLBQYAAAAAAQABAH4AAAByAQAAAAA=</BinaryData>
            </AppDocument>
         </MessageData>
      </processCanonicalService></s:Body></s:Envelope>
' ;