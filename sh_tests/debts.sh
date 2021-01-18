#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/DebtsInfoService/getDebtsInfo'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/debts >> output.xml -d '<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:deb="http://ovirugservice.ru/rsmev/debts" xsi:schemaLocation="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
    <s:Header>
        <wsse:Security s:actor="http://smev.gosuslugi.ru/actors/smev">
            <wsse:BinarySecurityToken EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" wsu:Id="SenderCertificate">MIIKFjCCCcOgAwIBAgIQM2+DAJisfZRI1Bq/Xld8KDAKBggqhQMHAQEDAjCCAYgx
HDAaBgkqhkiG9w0BCQEWDWNhQGlhYy5zcGIucnUxGDAWBgUqhQNkARINMTAzNzg0
MzA0MjkwNzEaMBgGCCqFAwOBAwEBEgwwMDc4MTUwMDA4NzAxCzAJBgNVBAYTAlJV
MSkwJwYDVQQIDCA3OCDQodCw0L3QutGCLdCf0LXRgtC10YDQsdGD0YDQszEmMCQG
A1UEBwwd0KHQsNC90LrRgi3Qn9C10YLQtdGA0LHRg9GA0LMxYzBhBgNVBAkMWtCi
0YDQsNC90YHQv9C+0YDRgtC90YvQuSDQv9C10YDQtdGD0LvQvtC6LCDQtC42LCDQ
m9C40YLQtdGAINCQLCDQv9C+0LzQtdGJ0LXQvdC40Y8gN9CdIDjQnTEZMBcGA1UE
CwwQ0J7RgtC00LXQuyDihJY0MDEoMCYGA1UECgwf0KHQn9CxINCT0KPQnyDCq9Ch
0J/QsSDQmNCQ0KbCuzEoMCYGA1UEAwwf0KHQn9CxINCT0KPQnyDCq9Ch0J/QsSDQ
mNCQ0KbCuzAeFw0yMDEyMjEwNzQ4MzJaFw0yMTEyMjEwNzQ4MzJaMIICGjFgMF4G
A1UECQxX0J/QtdGA0LXRg9C70L7QuiDQotGA0LDQvdGB0L/QvtGA0YLQvdGL0Lks
IDYsINCb0LjRgtC10YAg0JAsINC/0L7QvNC10YnQtdC90LjRjyA30J0gONCdMRYw
FAYFKoUDZAMSCzA1MTMzNzI0MDIxMRgwFgYFKoUDZAESDTEwMzc4NDMwNDI5MDcx
GjAYBggqhQMDgQMBARIMMDA3ODE1MDAwODcwMSYwJAYJKoZIhvcNAQkBFhdyb21h
bi5pdmFub3ZAaWFjLnNwYi5ydTELMAkGA1UEBhMCUlUxKTAnBgNVBAgMIDc4INCh
0LDQvdC60YIt0J/QtdGC0LXRgNCx0YPRgNCzMSYwJAYDVQQHDB3QodCw0L3QutGC
LdCf0LXRgtC10YDQsdGD0YDQszEoMCYGA1UECgwf0KHQn9CxINCT0KPQnyDCq9Ch
0J/QsSDQmNCQ0KbCuzEbMBkGA1UECwwS0J7RgtC00LXQuyDihJYgMzM2MS4wLAYD
VQQqDCXQoNC+0LzQsNC9INCQ0LvQtdC60YHQsNC90LTRgNC+0LLQuNGHMRUwEwYD
VQQEDAzQmNCy0LDQvdC+0LIxKDAmBgNVBAwMH9Cd0LDRh9Cw0LvRjNC90LjQuiDQ
vtGC0LTQtdC70LAxKDAmBgNVBAMMH9Ch0J/QsSDQk9Cj0J8gwqvQodCf0LEg0JjQ
kNCmwrswZjAfBggqhQMHAQEBATATBgcqhQMCAiQABggqhQMHAQECAgNDAARALwLE
Qw+cWT5k82prJhM3bZsST6HE+dxS6jAfvSEoKoAa3QPter96kccdKZ/A6v7FnFxa
88BxKQcDgADM2vjaPaOCBWowggVmMA4GA1UdDwEB/wQEAwIE8DAdBgNVHQ4EFgQU
tUMuXSJPQGBBeFyA7GGXunmHdMswJQYDVR0lBB4wHAYIKwYBBQUHAwIGCCsGAQUF
BwMBBgYqhQNkAgIwgasGCCsGAQUFBwEBBIGeMIGbMDEGCCsGAQUFBzAChiVodHRw
Oi8vY2EuaWFjLnNwYi5ydS9jZXJ0L2lhY19jb20uY2VyMDIGCCsGAQUFBzAChiZo
dHRwOi8vNDYuMjQzLjE3Ny4xMTQvY2VydC9pYWNfY29tLmNlcjAyBggrBgEFBQcw
AoYmaHR0cDovLzEwLjE0Ni4xNDAuMjUxL2NlcnQvaWFjX2NvbS5jZXIwEwYDVR0g
BAwwCjAIBgYqhQNkcQEwKQYDVR0RBCIwIIIOMTkyLjE2OC4xMDIuMjiCDjEwLjE0
Ni4xNDAuMjI2MCsGA1UdEAQkMCKADzIwMjAxMjIxMDc0ODMyWoEPMjAyMTEyMjEw
NzQ4MzJaMIIB1QYFKoUDZHAEggHKMIIBxgxHItCa0YDQuNC/0YLQvtCf0YDQviBD
U1AiINCy0LXRgNGB0LjRjyA0LjAgKNC40YHQv9C+0LvQvdC10L3QuNC1IDMtQmFz
ZSkMgbgi0J/RgNC+0LPRgNCw0LzQvNC90L4t0LDQv9C/0LDRgNCw0YLQvdGL0Lkg
0LrQvtC80L/Qu9C10LrRgSAi0KPQtNC+0YHRgtC+0LLQtdGA0Y/RjtGJ0LjQuSDR
htC10L3RgtGAICLQmtGA0LjQv9GC0L7Qn9GA0L4g0KPQpiIg0LLQtdGA0YHQuNC4
IDIuMCIgKNCy0LDRgNC40LDQvdGCINC40YHQv9C+0LvQvdC10L3QuNGPIDYpDF/Q
odC10YDRgtC40YTQuNC60LDRgiDRgdC+0L7RgtCy0LXRgtGB0YLQstC40Y8g0KTQ
odCRINCg0L7RgdGB0LjQuCDQodCkLzEyNC0zMzgxINC+0YIgMTEuMDUuMjAxOAxf
0KHQtdGA0YLQuNGE0LjQutCw0YIg0YHQvtC+0YLQstC10YLRgdGC0LLQuNGPINCk
0KHQkSDQoNC+0YHRgdC40Lgg0KHQpC8xMjgtMzU5MyDQvtGCIDE3LjEwLjIwMTgw
IwYFKoUDZG8EGgwYItCa0YDQuNC/0YLQvtCf0YDQviBDU1AiMIGRBgNVHR8EgYkw
gYYwKqAooCaGJGh0dHA6Ly9jYS5pYWMuc3BiLnJ1L2NybC9pYWNfY29tLmNybDAr
oCmgJ4YlaHR0cDovLzQ2LjI0My4xNzcuMTE0L2NybC9pYWNfY29tLmNybDAroCmg
J4YlaHR0cDovLzEwLjE0Ni4xNDAuMjUxL2NybC9pYWNfY29tLmNybDCCAV8GA1Ud
IwSCAVYwggFSgBRohKhnRZn9IOBiPWOKgQ3DHe9pO6GCASykggEoMIIBJDEeMBwG
CSqGSIb3DQEJARYPZGl0QG1pbnN2eWF6LnJ1MQswCQYDVQQGEwJSVTEYMBYGA1UE
CAwPNzcg0JzQvtGB0LrQstCwMRkwFwYDVQQHDBDQsy4g0JzQvtGB0LrQstCwMS4w
LAYDVQQJDCXRg9C70LjRhtCwINCi0LLQtdGA0YHQutCw0Y8sINC00L7QvCA3MSww
KgYDVQQKDCPQnNC40L3QutC+0LzRgdCy0Y/Qt9GMINCg0L7RgdGB0LjQuDEYMBYG
BSqFA2QBEg0xMDQ3NzAyMDI2NzAxMRowGAYIKoUDA4EDAQESDDAwNzcxMDQ3NDM3
NTEsMCoGA1UEAwwj0JzQuNC90LrQvtC80YHQstGP0LfRjCDQoNC+0YHRgdC40LiC
Cl490pkAAAAAAtcwCgYIKoUDBwEBAwIDQQDGjggWaSJ+QP1minnmQzOkdDLlYzfN
D56obmE+3Nng/9Z+lYZkhc34pdJhstEhVUJZsaTM+jMj6StZJwOwERX2</wsse:BinarySecurityToken>
            <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
                <SignedInfo>
                    <CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                    <SignatureMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256"/>
                    <Reference URI="#body">
                        <Transforms>
                            <Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                        </Transforms>
                        <DigestMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256"/>
                        <DigestValue>hOfSOnrhsuYvo78qOEB3vfspucmfbqDgDfIgMjQ1C90=</DigestValue>
                    </Reference>
                </SignedInfo>
                <SignatureValue></SignatureValue>
                <KeyInfo>
                    <wsse:SecurityTokenReference>
                        <wsse:Reference URI="#SenderCertificate" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3"/>
                    </wsse:SecurityTokenReference>
                </KeyInfo>
            </Signature>
        </wsse:Security>
    </s:Header>
    <s:Body wsu:Id="body">
        <rev:getDebtsInfo>
            <rev:Message>
                <rev:Sender>
                    <rev:Code>KIS001781</rev:Code>
                    <rev:Name>КИС СПб</rev:Name>
                </rev:Sender>
                <rev:Recipient>
                    <rev:Code>MNEM12345</rev:Code>
                    <rev:Name>ИАЦ</rev:Name>
                </rev:Recipient>
                <rev:Originator>
                    <rev:Code>KIS001781</rev:Code>
                    <rev:Name>КИС СПб</rev:Name>
                </rev:Originator>
                <rev:ServiceName>Get Debts Info</rev:ServiceName>
                <rev:TypeCode>GSRV</rev:TypeCode>
                <rev:Status>REQUEST</rev:Status>
                <rev:Date>2021-01-01T10:30:00.452+04:00</rev:Date>
                <rev:ExchangeType>2</rev:ExchangeType>
            </rev:Message>
            <rev:MessageData>
                <rev:AppData>
                    <deb:Request>
                        <deb:last_name>Бойцов</deb:last_name>
                        <deb:first_name>Вадим</deb:first_name>
                        <deb:second_name>Геннадьевич</deb:second_name>
                        <deb:street_code>7185</deb:street_code>
                        <deb:street_name>Большая Пушкарская ул.</deb:street_name>
                        <deb:personal_account>12345</deb:personal_account>
                        <deb:house>27</deb:house>
                        <deb:block></deb:block>
                        <deb:flat>7</deb:flat>
                        <deb:debt_summ>999.9</deb:debt_summ>
                        <deb:debt_period>90</deb:debt_period>
                        <deb:org_name></deb:org_name>
                    </deb:Request>
                </rev:AppData>
            </rev:MessageData>
        </rev:getDebtsInfo>
    </s:Body>
</s:Envelope>
';