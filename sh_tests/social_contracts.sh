#!/bin/bash
echo '' > output.xml;
echo -e '============================ GetForm9Async ============================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/DN_Service/GetContract'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/social_contracts >> output.xml -d '<?xml version="1.0"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><soapenv:Header xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><wsse:BinarySecurityToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" Id="4c745f57-c50a-4611-a06f-e557d135600e" EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" u:Id="4c745f57-c50a-4611-a06f-e557d135600e">MIIBDDCBugIJAI6DxIvtX2AzMAoGBiqFAwICAwUAMA0xCzAJBgNVBAYTAnJ1MB4XDTE4MDcwMzE2MjY1N1oXDTE5MDcwMzE2MjY1N1owDTELMAkGA1UEBhMCcnUwYzAcBgYqhQMCAhMwEgYHKoUDAgIjAQYHKoUDAgIeAQNDAARAJ9icTf7T6BpH5u4vCLLQUWI5jqXmCRUaJvW0YozMcsqYzRocMZihI3RAkp2P8Yk58Kx7se9imYzl7SabW4e67jAKBgYqhQMCAgMFAANBAChd14fMYZDN/XHWtxNB6awzobXBWj0cVckw4HPh8KOmybAM68NfvEsCoqcY7a1yCQu9xJbQlrZ7h3B8NK4phmk=</wsse:BinarySecurityToken><ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/><ds:Reference URI="#bId"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/><ds:DigestValue>CnYi+fw87ZCkjsDrM+4sp0bMNvhq55JW2Hg9zr/WoOY=</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue>gH33NDfjuYBzGg3NEAIQk9m1wTDGgQ2l6LkZ1qgTNu4PQo1Osp7o08XYz5NQ0r+MlYZPvym6ygZHbHa0DZgZRg==</ds:SignatureValue><ds:KeyInfo><wsse:SecurityTokenReference><wsse:Reference URI="#4c745f57-c50a-4611-a06f-e557d135600e" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3&quot;"/></wsse:SecurityTokenReference></ds:KeyInfo></ds:Signature></wsse:Security></soapenv:Header><s:Body u:Id="bId" Id="bId"><dkRequest xmlns="http://ec.minregion.ru/">
         <Message xmlns="http://smev.gosuslugi.ru/rev120315">
            <Sender>
               <Code>001801781</Code>
               <Name>КИС СПб</Name>
            </Sender>
            <Recipient>
               <Code>IAC</Code>
               <Name>ИАЦ</Name>
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
               <BinaryData>UEsDBBQAAAAIAJSK8kzrTMgc9wAAAF8BAAAsAAAAcmVxX2NjMTU0Y2ZjLTE4ZjQtNDdhZC04YTE3LTU5OTY1ZjYxYzQ1MS54bWyFkLtKxEAUhnvBdxim3zmJ2yzLZBZExEIbt7EN2WN2IJnRuZgtvZQ+goWlraCiUfQZJm/kmA1pbQ7n8n1w+PliU1fkCo2VWmU0ZQklqAq9kqrMqHfnkxldiN0dfoqXHq0jEVd2vrEyo2vnLuYATdOwZsq0KWEvSVI4OzleFmus84lU1uWqQDpaq/+tAR5BLFgtlcFSasWMBxq/IYQfSOuMLJwIj+Gtu+2uw094ifU5vHY34TN8hJbDCPXK0hnEKDzE43t3T8JTpNue/Y52S7q78MU4DFzvHGlvUaQzDtuuX+57Wf0FRGA7H1a5E9OEQ9/EsGBIS/wCUEsBAh8AFAAAAAgAlIryTOtMyBz3AAAAXwEAACwAJAAAAAAAAAAgAAAAAAAAAHJlcV9jYzE1NGNmYy0xOGY0LTQ3YWQtOGExNy01OTk2NWY2MWM0NTEueG1sCgAgAAAAAAABABgAb2ufgaIe1AH1oZ2Boh7UASxA9omBhs0BUEsFBgAAAAABAAEAfgAAAEEBAAAAAA==</BinaryData>
            </AppDocument>
         </MessageData>
      </dkRequest></s:Body></s:Envelope>' ;