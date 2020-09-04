#!/bin/bash
echo '' > output.xml;
echo -e '========================================================\n' >> output.xml;

curl -H "SOAPAction: 'http://tempuri.org/DebtsInfoService/getDebtsInfo'" -H "Content-Type: text/xml;charset=UTF-8" -X POST http://127.0.0.1/rsmev/debts >> output.xml -d '<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:deb="http://ovirugservice.ru/rsmev/debts" xsi:schemaLocation="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
    <s:Header>
        <wsse:Security s:actor="http://smev.gosuslugi.ru/actors/smev">
            <wsse:BinarySecurityToken EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary" ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509v3" wsu:Id="SenderCertificate">
                MIILIjCCCs+gAwIBAgIQNYjaACirQYFINaS7OVhMXTAKBggqhQMHAQEDAjCCAYgx
                HDAaBgkqhkiG9w0BCQEWDWNhQGlhYy5zcGIucnUxGDAWBgUqhQNkARINMTAzNzg0
                MzA0MjkwNzEaMBgGCCqFAwOBAwEBEgwwMDc4MTUwMDA4NzAxCzAJBgNVBAYTAlJV
                MSkwJwYDVQQIDCA3OCDQodCw0L3QutGCLdCf0LXRgtC10YDQsdGD0YDQszEmMCQG
                A1UEBwwd0KHQsNC90LrRgi3Qn9C10YLQtdGA0LHRg9GA0LMxYzBhBgNVBAkMWtCi
                0YDQsNC90YHQv9C+0YDRgtC90YvQuSDQv9C10YDQtdGD0LvQvtC6LCDQtC42LCDQ
                m9C40YLQtdGAINCQLCDQv9C+0LzQtdGJ0LXQvdC40Y8gN9CdIDjQnTEZMBcGA1UE
                CwwQ0J7RgtC00LXQuyDihJY0MDEoMCYGA1UECgwf0KHQn9CxINCT0KPQnyDCq9Ch
                0J/QsSDQmNCQ0KbCuzEoMCYGA1UEAwwf0KHQn9CxINCT0KPQnyDCq9Ch0J/QsSDQ
                mNCQ0KbCuzAeFw0xOTEyMTkxMzA1NDBaFw0yMDEyMTkxMzA1NDBaMIICGjFgMF4G
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
                kNCmwrswZjAfBggqhQMHAQEBATATBgcqhQMCAiQABggqhQMHAQECAgNDAARAfStB
                bPEaejXemtiLduraDLzrob07OnrtA0sDaxHZMAAOXe4acCCsgRER1HIqcQo4/nYi
                fUIFJKfRbcqrfWBIr6OCBnYwggZyMA4GA1UdDwEB/wQEAwIE8DAdBgNVHQ4EFgQU
                gBTttZexyYSdhrW+sAXNUm5EwD4wJQYDVR0lBB4wHAYIKwYBBQUHAwIGBiqFA2QC
                AgYIKwYBBQUHAwEwggFrBggrBgEFBQcBAQSCAV0wggFZMDQGCCsGAQUFBzABhiho
                dHRwOi8vNDYuMjQzLjE3Ny4xMTQvb2NzcC0yMDE5L29jc3Auc3JmMDQGCCsGAQUF
                BzABhihodHRwOi8vMTAuMTQ2LjE0MC4yNTEvb2NzcC0yMDE5L29jc3Auc3JmMDkG
                CCsGAQUFBzAChi1odHRwOi8vY2EuaWFjLnNwYi5ydS9jZXJ0L2lhY19nb3N0MTJf
                MjAxOS5jZXIwOgYIKwYBBQUHMAKGLmh0dHA6Ly80Ni4yNDMuMTc3LjExNC9jZXJ0
                L2lhY19nb3N0MTJfMjAxOS5jZXIwOAYIKwYBBQUHMAKGLGh0dHA6Ly8xMC4xMjgu
                MzEuNjUvY2VydC9pYWNfZ29zdDEyXzIwMTkuY2VyMDoGCCsGAQUFBzAChi5odHRw
                Oi8vMTAuMTQ2LjE0MC4yNTEvY2VydC9pYWNfZ29zdDEyXzIwMTkuY2VyMBMGA1Ud
                IAQMMAowCAYGKoUDZHEBMCkGA1UdEQQiMCCCDjE5Mi4xNjguMTAyLjI4gg4xMC4x
                NDYuMTQwLjIyNjArBgNVHRAEJDAigA8yMDE5MTIxOTEzMDUzOVqBDzIwMjAxMjE5
                MTMwNTM5WjCCAdUGBSqFA2RwBIIByjCCAcYMRyLQmtGA0LjQv9GC0L7Qn9GA0L4g
                Q1NQIiDQstC10YDRgdC40Y8gNC4wICjQuNGB0L/QvtC70L3QtdC90LjQtSAyLUJh
                c2UpDIG4ItCf0YDQvtCz0YDQsNC80LzQvdC+LdCw0L/Qv9Cw0YDQsNGC0L3Ri9C5
                INC60L7QvNC/0LvQtdC60YEgItCj0LTQvtGB0YLQvtCy0LXRgNGP0Y7RidC40Lkg
                0YbQtdC90YLRgCAi0JrRgNC40L/RgtC+0J/RgNC+INCj0KYiINCy0LXRgNGB0LjQ
                uCAyLjAiICjQstCw0YDQuNCw0L3RgiDQuNGB0L/QvtC70L3QtdC90LjRjyA1KQxf
                0KHQtdGA0YLQuNGE0LjQutCw0YIg0YHQvtC+0YLQstC10YLRgdGC0LLQuNGPINCk
                0KHQkSDQoNC+0YHRgdC40Lgg0KHQpC8xMjQtMzM4MCDQvtGCIDExLjA1LjIwMTgM
                X9Ch0LXRgNGC0LjRhNC40LrQsNGCINGB0L7QvtGC0LLQtdGC0YHRgtCy0LjRjyDQ
                pNCh0JEg0KDQvtGB0YHQuNC4INCh0KQvMTI4LTM1OTIg0L7RgiAxNy4xMC4yMDE4
                MCMGBSqFA2RvBBoMGCLQmtGA0LjQv9GC0L7Qn9GA0L4gQ1NQIjCB3AYDVR0fBIHU
                MIHRMDKgMKAuhixodHRwOi8vY2EuaWFjLnNwYi5ydS9jcmwvaWFjX2dvc3QxMl8y
                MDE5LmNybDAzoDGgL4YtaHR0cDovLzQ2LjI0My4xNzcuMTE0L2NybC9pYWNfZ29z
                dDEyXzIwMTkuY3JsMDGgL6AthitodHRwOi8vMTAuMTI4LjMxLjY1L2NybC9pYWNf
                Z29zdDEyXzIwMTkuY3JsMDOgMaAvhi1odHRwOi8vMTAuMTQ2LjE0MC4yNTEvY3Js
                L2lhY19nb3N0MTJfMjAxOS5jcmwwggFfBgNVHSMEggFWMIIBUoAUh5MGP1AjRBWX
                RZyoA1I3gRPTJtmhggEspIIBKDCCASQxHjAcBgkqhkiG9w0BCQEWD2RpdEBtaW5z
                dnlhei5ydTELMAkGA1UEBhMCUlUxGDAWBgNVBAgMDzc3INCc0L7RgdC60LLQsDEZ
                MBcGA1UEBwwQ0LMuINCc0L7RgdC60LLQsDEuMCwGA1UECQwl0YPQu9C40YbQsCDQ
                otCy0LXRgNGB0LrQsNGPLCDQtNC+0LwgNzEsMCoGA1UECgwj0JzQuNC90LrQvtC8
                0YHQstGP0LfRjCDQoNC+0YHRgdC40LgxGDAWBgUqhQNkARINMTA0NzcwMjAyNjcw
                MTEaMBgGCCqFAwOBAwEBEgwwMDc3MTA0NzQzNzUxLDAqBgNVBAMMI9Cc0LjQvdC6
                0L7QvNGB0LLRj9C30Ywg0KDQvtGB0YHQuNC4ggoX69zhAAAAAALWMAoGCCqFAwcB
                AQMCA0EA4mOTpUHugm4iQr3/ExEw5h4EdEMnxAHS9Q9qy13AvkZxLrs5BEGhnLPJ
                NDfm6UYeYUi4ujE6WFNyUrdK7rgZ9g==
            </wsse:BinarySecurityToken>
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
                <SignatureValue>EyHAshStjvCwEo3Ax0hrpR8bNO2Hb9lBn3oiLDNXd6P317HmzeDVX4l9kjHEAmIa
n6KdkfP0olt+RXDUnEn7XA==</SignatureValue>
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
                <rev:Date>2018-03-07T10:30:00.452+04:00</rev:Date>
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
                        <deb:flat>7</deb:flat>
                        <deb:debt_summ>999.9</deb:debt_summ>
                        <deb:debt_period>90</deb:debt_period>
                    </deb:Request>
                </rev:AppData>
            </rev:MessageData>
        </rev:getDebtsInfo>
    </s:Body>
</s:Envelope>
';