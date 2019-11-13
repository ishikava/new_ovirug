<?php

$content = '<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope
         xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
         xmlns:ns="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.1"
         xmlns:ns2="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.1"
         xmlns:ns3="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/faults/1.1"
         xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
    <s:Body>
        <ns:SendRequestRequest>
            <ns:SenderProvidedRequestData Id="SIGNED_BY_CONSUMER" wsu:Id="SIGNED_BY_CONSUMER">
                <ns:MessageID>'.$data['MessageID'].'</ns:MessageID>
                <ns2:MessagePrimaryContent xmlns:ns2="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.1">
                    <rq:FNSINNSingularRequest ИдЗапрос="'.$data['MessageID'].'" xmlns:rq="urn://x-artefacts-fns-inn-singular/root/270-18/4.0.1">
                        <rq:СведЮЛ ОГРН="'.$data['legal_entity']['ogrn'].'" ИННЮЛ="'.$data['legal_entity']['inn'].'" НаимОрг="'.$data['legal_entity']['name'].'"/>
                        <rq:СведФЛ ДатаРожд="'.$data['individual']['birthDay'].'" МестоРожд="'.$data['individual']['birthPlace'].'">
                            <com:ФИО Имя="'.$data['individual']['firstName'].'" Фамилия="'.$data['individual']['lastName'].'" Отчество="'.$data['individual']['secondName'].'" xmlns:com="urn://x-artefacts-fns-inn/commons/4.0.0"/>
                            <com:УдЛичнФЛ КодВидДок="'.$data['individual']['document']['docCode'].'" СерНомДок="'.$data['individual']['document']['number'].'" ДатаДок="'.$data['individual']['document']['date'].'" ВыдДок="'.$data['individual']['document']['issueName'].'" КодВыдДок="'.$data['individual']['document']['issueCode'].'" xmlns:com="urn://x-artefacts-fns-inn/commons/4.0.0"/>
                        </rq:СведФЛ>
                    </rq:FNSINNSingularRequest>
                </ns2:MessagePrimaryContent>
                <ns:TestMessage></ns:TestMessage>
            </ns:SenderProvidedRequestData>
            <ns:CallerInformationSystemSignature>
                <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                    <ds:SignedInfo>
                        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                        <ds:SignatureMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256"/>
                        <ds:Reference URI="#SIGNED_BY_CONSUMER">
                            <ds:Transforms>
                                <ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                            </ds:Transforms>
                            <ds:DigestMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256"/>
                            <ds:DigestValue></ds:DigestValue>
                        </ds:Reference>
                    </ds:SignedInfo>
                    <ds:SignatureValue></ds:SignatureValue>
                    <ds:KeyInfo></ds:KeyInfo>
                </ds:Signature>
            </ns:CallerInformationSystemSignature>
        </ns:SendRequestRequest>
    </s:Body>
</s:Envelope>';