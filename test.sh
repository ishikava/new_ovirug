#!/bin/bash
echo '' > output.xml;
echo -e '============================ GetForm9Async ============================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/DN_Service/GetContract'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/social_contracts >> output.xml -d '<?xml version="1.0" encoding="UTF-8"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><s:Header><wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" s:actor="http://smev.gosuslugi.ru/actors/smev"><wsse:BinarySecurityToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" wsu:Id="CertId-C7D66FF86893DEC724141519235409475718" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">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</wsse:BinarySecurityToken><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-37569">
<ds:SignedInfo>
<ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
<ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/>
<ds:Reference URI="#_2">
<ds:Transforms>
<ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
</ds:Transforms>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/>
<ds:DigestValue>zFuYFCHMgugxWa3FEHByo3qEipqDEDjHFEcVq5TmKYo=</ds:DigestValue>
</ds:Reference>
</ds:SignedInfo>
<ds:SignatureValue>
MBWu+qHFdGxUn+CyOjB4H/cBuSiOjeEgXAXNnRV4qOKqPDA7kvG7VTd7ZnRTZXy31xDXahJEzWaF
AZnVyFEZnQ==
</ds:SignatureValue>
<ds:KeyInfo Id="KeyId-C7D66FF86893DEC724141519235409475719">
<wsse:SecurityTokenReference xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="STRId-C7D66FF86893DEC724141519235409475720" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><wsse:Reference URI="#CertId-C7D66FF86893DEC724141519235409475718" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"/></wsse:SecurityTokenReference>
</ds:KeyInfo>
</ds:Signature></wsse:Security></s:Header><s:Body u:Id="_2"><dkRequest xmlns="http://ec.minregion.ru/">
         <Message xmlns="http://smev.gosuslugi.ru/rev120315">
            <Sender>
               <Code>001801781</Code>
               <Name>КИС СПб</Name>
            </Sender>
            <Recipient>
               <Code>VCKP</Code>
               <Name>ВЦКП</Name>
            </Recipient>
            <Originator>
               <Code>001801781</Code>
               <Name>КИС СПб</Name>
            </Originator>
            <TypeCode>GSRV</TypeCode>
            <Status>REQUEST</Status>
            <Date>2014-11-05T15:59:58.791371+04:00</Date>
         </Message>
         <MessageData xmlns="http://smev.gosuslugi.ru/rev120315">
            <AppDocument>
               <RequestCode>req_cc154cfc-18f4-47ad-8a17-59965f61c451</RequestCode>
               <BinaryData>UEsDBBQAAAAIAP1bHkG2ySO68gAAAFQBAAAsACQAcmVxX2NjMTU0Y2ZjLTE4ZjQtNDdhZC04YTE3LTU5OTY1ZjYxYzQ1MS54bWwKACAAAAAAAAEAGAAsQPaJgYbNASxA9omBhs0BLED2iYGGzQGFkE1OwzAQhfdI3MHyvp40bKByXKkLxKJs6IZt5A6ppcShtkPKLSoQIFGBQByAA7DgCnMTroBJo2xZPM3P+0YavZ+vbzndVCW7QedNbTM+FglnaHW9NLbIeBOuRsd8qg4P5AWuG/SBRdz6ycabjK9CuJ4AtG0r2iNRuwLSJBnD5fl8oVdY5SNjfcitRj5cLf+/6uEBRC0qYx0W8UHhGuDxG8bkvNZ5acKtoid6oF3UC73SfdQbvdOzhAHo8EVwiEFF+y4CW3qM+JY+GX3QTkjo7Q49qxuPKj2RsO+65awx5V8mDPbzaZkHlUroaowH+nzUL1BLAQItABQAAAAIAP1bHkG2ySO68gAAAFQBAAAsACQAAAAAAAAAAAAAAAAAAAByZXFfY2MxNTRjZmMtMThmNC00N2FkLThhMTctNTk5NjVmNjFjNDUxLnhtbAoAIAAAAAAAAQAYACxA9omBhs0BLED2iYGGzQEsQPaJgYbNAVBLBQYAAAAAAQABAH4AAABgAQAAAAA=</BinaryData>
            </AppDocument>
         </MessageData>
      </dkRequest></s:Body></s:Envelope>
' ;